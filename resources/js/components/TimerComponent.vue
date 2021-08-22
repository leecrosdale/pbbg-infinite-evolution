<template>
    <span v-if="currentSeconds > 0">
        {{ currentSeconds }}
    </span>
    <span v-else>
        <slot/>
    </span>
</template>

<script>
export default {
    props: [
        'seconds',
        'reloadOnFinish',
    ],

    data() {
        return {
            currentSeconds: this.seconds,
        };
    },

    mounted() {
        this.intervalId = window.setInterval(() => this.tick(), 1000);
    },

    methods: {
        tick() {
            this.currentSeconds--;

            if (this.currentSeconds <= 0) {
                window.clearInterval(this.intervalId);

                if (this.reloadOnFinish) {
                    location.reload();
                }
            }
        },
    },
}
</script>
