<template>
	<div>
		<p>{{time.h}}h : {{time.mn}}mn : {{time.s}}s : {{time.ms}}ms</p>
		<span class="icon is-small">
		  <i :class="{'fa fa-play': true, 'disabled': state == 'start'}" @click.prevent="start"></i>
		</span>
		<span class="icon is-small">
		  <i :class="{'fa fa-pause': true, 'disabled': state == 'pause'}" @click.prevent="pause"></i>
		</span>
		<span class="icon is-small">
		  <i :class="{'fa fa-stop': true, 'disabled': state == 'stop'}" @click.prevent="stop"></i>
		</span>
		<span class="icon is-small">
		  <i :class="{'fa fa-undo': true, 'disabled': state == 'reset'}" @click.prevent="reset"></i>
		</span>
	</div>
</template>

<script>
	export default {
		props: {
			lot_id: {type: Number, default: null}
		},
		data() {
			return {
				time: {
					h: 0,
					mn: 0,
					s: 0,
					ms: 0
				},
				t: '',
				state: ''
			}
		},
		methods: {
			update() {
				this.time.ms++;
				if (this.time.ms == 10) {
					this.time.ms = 0
					this.time.s++
				}
				if (this.time.s == 60) {
					this.$parent.saveChrono(this.time, this.lot_id)
					this.time.s = 0
					this.time.mn++
				}
				if (this.time.mn == 60) {
					this.time.mn = 0
					this.time.h++
				}
			},

			start() {
				if (this.state != 'start') {
					this.state = 'start'
					this.t = setInterval(this.update, 100)
					this.$parent.timePaused = false
				}
			},

			pause() {
				if (this.state != 'pause') {
					this.state = 'pause'
					clearInterval(this.t);
					this.$parent.pauseChrono(this.time, this.lot_id)
				}
			},

			reset() {
				if (this.state != 'reset') {
					this.state = 'reset'
					clearInterval(this.t)
					this.time.h = 0
					this.time.mn = 0
					this.time.s = 0
					this.time.ms = 0
					this.$parent.timePaused = false
				}
			},

			stop() {
				if (this.state != 'stop') {
					this.state = 'stop'
					clearInterval(this.t)
					this.$parent.stopChrono(this.time, this.lot_id)
				}
			}
		}
	}
</script>

<style scoped>
	.disabled {
		opacity: 0.4;
		pointer-events: none;
	}

	.fa-play {
		color: #00d1b2;
		cursor: pointer;
	}

	.fa-pause {
		color: #ffdd57;
		cursor: pointer;
	}

	.fa-stop {
		color: #ff3860;
		cursor: pointer;
	}
</style>