<template>
    <div id="article-chart" class="bg-light" style="height:400px;"></div>
</template>

<script>
export default {
    name: 'article-chart',
    props: {
        title: String,
        legend: String,
    },
    mounted() {
        this.drawLine();
    },
    methods: {
        drawLine() {
            let instance = this;
            axios.get('/article/chart', {},  {
                    headers: {
                        // language=JQuery-CSS
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
            .then(function(res) {
                let labelList = res.data.map(function (item){ return item[0]; });
                let dataList = res.data.map(function (item){ return item[1]; });
                let option = {
                    title: {
                        text: instance.title
                    },
                    tooltip: {},
                    legend: {
                        data:[instance.legend]
                    },
                    xAxis: {
                        data: labelList
                    },
                    yAxis: {},
                    series: [{
                        name: instance.legend,
                        type: 'bar',
                        itemStyle: {
                            color: new echarts.graphic.LinearGradient(
                                0, 0, 0, 1,
                                [
                                    {offset: 0, color: '#83bff6'},
                                    {offset: 0.5, color: '#188df0'},
                                    {offset: 1, color: '#188df0'}
                                ]
                            )
                        },
                        emphasis: {
                            itemStyle: {
                                color: new echarts.graphic.LinearGradient(
                                    0, 0, 0, 1,
                                    [
                                        {offset: 0, color: '#2378f7'},
                                        {offset: 0.7, color: '#2378f7'},
                                        {offset: 1, color: '#83bff6'}
                                    ]
                                )
                            }
                        },
                        data: dataList
                    }]
                };
                let myChart = echarts.init(document.getElementById('article-chart'));
                myChart.setOption(option);
            }).catch(function(err) {
                console.error(err);
            });
        }
    }
}
</script>

<style>
#article-chart {
    margin-top: 0.5rem;
    padding: 1rem 1rem;
    border-radius: 0.5rem;
}
</style>