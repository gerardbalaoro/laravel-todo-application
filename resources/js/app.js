import "./bootstrap";
import "flowbite";

Alpine.store("taskRepository", {
    items: [],
    loading: false,
    find(id) {
        return this.items.find((item) => item.id == id);
    },
    async fetch() {
        this.loading = true;
        await axios
            .get("/api/v1/tasks")
            .then((response) => {
                this.items = response.data.data;
            })
            .catch((error) => {
                const response = error.response.data;
                window.toast("Unable to retrieve tasks", {
                    type: "danger",
                    description:
                        response.message ?? response.error.message ?? null,
                });
            });

        this.loading = false;
    },
    async create(data) {
        axios
            .post("/api/v1/tasks", data)
            .then((response) => {
                this.items.push(response.data.data);
            })
            .catch((error) => {
                const response = error.response.data;
                window.toast("Unable to create task", {
                    type: "danger",
                    description:
                        response.message ?? response.error.message ?? null,
                });
                this.fetch();
            });
    },
    async update(id, data) {
        const task = this.find(id);
        if (!task) return;

        Object.assign(task, data);

        axios
            .put(`/api/v1/tasks/${id}`, data)
            .then((response) => {
                Object.assign(task, response.data.data);
            })
            .catch((error) => {
                const response = error.response.data;
                window.toast("Unable to update task", {
                    type: "danger",
                    description:
                        response.message ?? response.error.message ?? null,
                });
                this.fetch();
            });
    },
    async move(id, position) {
        const task = this.find(id);
        if (!task || task.position === position) return;

        const current = task.position;

        if (current < position) {
            this.items
                .filter(
                    (task) =>
                        task.position > current && task.position <= position
                )
                .forEach((task) => task.position--);
        } else {
            this.items
                .filter(
                    (task) =>
                        task.position >= position && task.position < current
                )
                .forEach((task) => task.position++);
        }

        task.position = position;
        this.items.sort((a, b) => a.position - b.position);
        this.update(id, { position });
    },
    async delete(id) {
        const i = this.items.findIndex((item) => item.id == id);
        const task = this.items[i];
        if (!task) return;

        this.items.splice(i, 1);

        axios.delete(`/api/v1/tasks/${id}`).catch((error) => {
            const response = error.response.data;
            window.toast("Unable to delete task", {
                type: "danger",
                description: response.message ?? response.error.message ?? null,
            });
            this.fetch();
        });
    },
});

Alpine.data("TaskList", () => ({
    init() {
        this.$store.taskRepository.fetch();
    },
}));

Alpine.data("TaskCreate", () => ({
    error: null,
    name: null,
    form: {
        ["@submit.prevent"]() {
            this.error = null;
            this.$store.taskRepository
                .create({ name: this.name })
                .then(() => {
                    this.name = null;
                })
                .catch((error) => {
                    this.error = error.response.data.message;
                });
        },
    },
}));

Alpine.data("Task", (task) => ({
    task,
    dropping: false,
    editing: false,
    trash() {
        this.$store.taskRepository.delete(this.task.id);
    },
    container: {
        ["@dragstart"](e) {
            e.dataTransfer.dropEffect = "move";
            e.dataTransfer.setData("text/plain", this.task.id);
        },
        ["@drop"](e) {
            this.dropping = false;
            const id = e.dataTransfer.getData("text/plain");
            this.$store.taskRepository.move(id, this.task.position);
        },
        ["@dragenter"](e) {
            this.dropping = true;
            e.preventDefault();
        },
        ["@dragover"](e) {
            this.dropping = true;
            e.preventDefault();
        },
        ["@dragleave"]() {
            this.dropping = false;
        },
    },
    content: {
        [":contenteditable"]() {
            return this.editing;
        },
        ["@click"]() {
            this.editing = true;
            this.$el.focus();
        },
        ["@blur"]() {
            this.editing = false;
        },
        ["@click.away"]() {
            this.editing = false;
        },
        ["@input.debounce"](e) {
            this.$store.taskRepository.update(this.task.id, {
                name: e.target.textContent.trim(),
            });
        },
    },
}));

Alpine.start();
