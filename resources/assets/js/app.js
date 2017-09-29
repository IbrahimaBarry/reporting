import './bootstrap';

window.success = function(message) {
    iziToast.success({
        title: 'OK',
        message: message,
        position: 'topCenter'
    });
};

window.error = function(message) {
    iziToast.error({
        title: 'Error',
        message: message,
        position: 'topCenter'
    });
};

window.warning = function(message) {
    iziToast.warning({
        title: 'Caution',
        message: message,
        position: 'topCenter'
    });
};

Vue.component('chrono', require('./components/Chrono'));

new Vue({
    el: '#app',
    data: {
        dropdownUser: false,
        showModal: false,
        showModalEdit: false,
        showModalDelete: false,
        showObservation: false,
        time: null,
        lot_id: null,
        timePaused: false,

        lots: {}
    },
    methods: {
        edit(lots) {
            this.lots = lots
            this.showModalEdit = true
        },
        updateLot () {
            axios.put('/lots/update', this.lots).then(response => {
                this.showModalEdit = false
                location.reload()
            })
        },
        stopChrono (time, lot_id) {
            this.time = (time.h * 3600) + (time.mn * 60) + time.s
            this.lot_id = lot_id
            this.showObservation = true
        },
        pauseChrono (time, lot_id) {
            this.timePaused = true
            this.time = (time.h * 3600) + (time.mn * 60) + time.s
            this.lot_id = lot_id
        }
    }
});
