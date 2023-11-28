
<template>
    <div>

        <button @click="addInput" type='button' class='break-inside bg-blue-600 rounded-xl p-4 mb-4 w-64'>
            <div class='flex items-center space-x-4'>
                <span class='text-base font-medium text-white'>Submit Another</span>
            </div>
        </button>

        
    </div>
</template>

<script>

export default {
    data() {
        return {
            inputs: [{ value: '' }],
            selected: null,
            options: ['list', 'of', 'options']
        };
    },
    methods: {
        addInput(e) {
            e.preventDefault();
            this.inputs.push({ value: '' });
        },
    }
};
</script>
