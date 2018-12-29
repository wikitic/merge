<template>
    <div class="card w-100 mt-2">
        <div class="card-body">
            {{ name }}
        </div>
    </div>
</template>

<script>
    export default {
        name: 'partner',
        props: ['name'],
    }
</script>