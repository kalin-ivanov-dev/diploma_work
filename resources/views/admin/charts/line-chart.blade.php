<div id="charts" class="flex mt-10 justify-center  bg-gray-200  p-4 py-12 rounded-xl mx-10">

    <div class="chart-container mx-14" style=" height:20%; width:20%">
        <canvas id="chart"></canvas>
    </div>



    <div class="chart-container border-l-4" style=" height:30%; width:30%">
        <canvas id="chart_line"></canvas>
    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

    // const labels = Utils.months({count: 7});
    const data_line = {
        labels: ['Test','Test2',"Test3"],
        datasets: [{
            label: 'Daily Users',
            data: [65, 59, 80, 81, 56, 55, 40],
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    };

    const config_line = {
        type: 'line',
        data: data_line,
    };

    const myChartLine = new Chart(
        document.getElementById('chart_line'),
        config_line
    );



    const ctx = document.getElementById('myChart');
    const data = {
        labels: [
            'Users',
            'Signals',
            'Comments'
        ],
        datasets: [{
            label: 'My First Dataset',
            data: [10, 500,250 ],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }]
    };

    const config = {
        type: 'doughnut',
        data: data,
    };

    const myChart = new Chart(
        document.getElementById('chart'),
        config
    );

    window.addEventListener('beforeprint', () => {
        myChart.resize(600, 600);
    });
    window.addEventListener('afterprint', () => {
        myChart.resize();
    });
</script>
