@props(['class'])

<form
    x-data="TaskCreate"
    x-bind="form"
    @class([
        $class,
        'flex items-center justify-beween gap-2 mb-4 p-6',
        'border rounded-md shadow-sm bg-white'
    ])
>
    <div class="w-full">
        <input
            type="text"
            x-model="name"
            :class="[
                'border border-gray-300 bg-gray-50 rounded-md focus:ring-purple-500 focus:border-purple-500 text-sm block w-full p-2',
                error ? 'border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 focus:border-red-500' : ''
            ]"
            placeholder="Task Name"
        />
    </div>
    <button
        type="submit"
        :class="[
            'p-2 text-white bg-purple-600 rounded-full shadow-sm',
            'hover:bg-purple-700 focus:outline-none focus:ring-4 focus:ring-purple-300'
        ]"
    >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </button>
</form>
