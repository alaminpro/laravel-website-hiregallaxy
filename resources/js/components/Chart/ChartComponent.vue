<script>
import {
    Bar
} from 'vue-chartjs'

export default {
    extends: Bar,
    props: {
        data: {
            type: Array,
            required: false,
        }
    },
    data() {
        return {
            suggest: 200,
            datas: []
        }
    },
    watch: {
        'data': function (res) {
            this.datas = res;
            this.chartRender()
        }
    },
    methods: {
        chartRender() {
            this.renderChart({
                labels: ['Posted ' + this.datas[0], 'Companies ' + this.datas[1], 'Applications ' + this.datas[2], 'New Applications ' + this.datas[3], 'Shortlisted Candidates ' + this.datas[4], 'Interviews ' + this.datas[5], 'Offered ' + this.datas[6], 'Hired ' + this.datas[7], 'Rejected ' + this.datas[8]],
                datasets: [{
                    backgroundColor: '#4f48b2',
                    data: this.datas
                }]
            }, {
                legend: {
                    display: false,
                },
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: this.suggest
                        }
                    }],
                },
            });
        }
    },
    mounted() {
        let url = "/api/employer/datas";
        let vm = this;
        axios.get(url).then(res => {
            this.datas = res.data
            this.chartRender()
        });
    }
}
</script>
