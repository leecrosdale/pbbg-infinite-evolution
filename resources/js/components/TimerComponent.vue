<template>
    <div v-if="currentSeconds > 0">
        {{ currentSeconds }}
    </div>
    <div v-else>
        <slot/>
    </div>
</template>

<script>
export default {
    props: [
        'seconds',
    ],

    data() {
        return {
            currentSeconds: this.seconds,
        };
    },

    mounted() {
        console.log('timer started');
        this.intervalId = window.setInterval(() => this.tick(), 1000);
    },

    methods: {
        tick() {
            console.log('timer tick');
            this.currentSeconds--;

            if (this.currentSeconds <= 0) {
                window.clearInterval(this.intervalId);
                console.log('timer done');
            }
        },
    },
}
</script>
