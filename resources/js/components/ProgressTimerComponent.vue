<template>
    <div v-if="showTimer" class="d-block">
        <div class="progress w-100">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                 role="progressbar"
                 v-bind:aria-valuenow="currentProgress"
                 aria-valuemin="0"
                 aria-valuemax="100"
                 v-bind:style="{ width: currentProgress + '%', height: '1rem' }">
            </div>
        </div>
        <small>Working</small>
    </div>
    <span v-else>
        <slot/>
    </span>
</template>

<script>
export default {
    props: [
        'startTime',
        'currentTime',
        'endTime',
    ],

    data() {
        return {
            startSeconds: (Date.parse(this.startTime) / 1000),
            currentSeconds: (Date.parse(this.currentTime) / 1000),
            endSeconds: (Date.parse(this.endTime) / 1000),
            showTimer: false,
            currentProgress: null,
        };
    },

    mounted() {
        this.showTimer = ((this.endTime !== '') && (this.currentSeconds < this.endSeconds));

        if (this.showTimer) {
            this.recalculateCurrentProgress();
            this.intervalId = window.setInterval(() => this.tick(), 1000);
        }
    },

    methods: {
        tick() {
            this.currentSeconds++;
            this.recalculateCurrentProgress();

            if (this.currentSeconds >= this.endSeconds) {
                this.showTimer = false;
                window.clearInterval(this.intervalId);
            }
        },

        recalculateCurrentProgress() {
            const upper = (this.endSeconds - this.startSeconds);
            const lower = (this.startSeconds - this.currentSeconds);

            this.currentProgress = (100 - Math.ceil(Math.abs((lower / upper) * 100)));
        },
    },
}
</script>
