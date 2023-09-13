<x-dashboard.layout title='Dashboard'>
    <style>
        .numbers {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .numbers div {
            padding: 10px 15px 10px 0;
            border-bottom: 2px solid #9E9E9E;
            width: 22%;
            display: flex;
            align-items: center;
            color: #607D8B;
        }

        .numbers div i {
            font-size: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .numbers div i.red {
            color: #009688;
            background-color: #00968852;

        }

        .numbers div i.yellow {
            background-color: #ff98005c;
            color: #FF9800;
        }

        .numbers div i.green {
            color: #4CAF50;
            background-color: #4caf5061;
        }

        .numbers div i.blue {
            color: #E91E63;
            background-color: #e91e6345;

        }
    </style>
    <div class="numbers">
        <div>
            <i class="fa fa-users red"></i>
            <span>Total Instructors <br> 55</span>
        </div>
        <div>
            <i class="fas fa-user-graduate yellow"></i>
            <span>Total Students <br> 55</span>
        </div>
        <div>
            <i class="fas fa-network-wired blue"></i>
            <span>Total Categories <br> 55</span>
        </div>
        <div>
            <i class="fas fa-book-medical green"></i>
            <span>Total Courses <br> 55</span>
        </div>
    </div>
    <div>
        <div>
            <canvas id="myChart"></canvas>
        </div>
    </div>
    <script src="
        https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js
        "></script>
    <script>
        const ctx = document.getElementById('myChart');
        const config = {
            type: 'doughnut',
            data: data,
        };
        // new Chart(ctx, {
        //     type: 'bar',
        //     data: {
        //         labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        //         datasets: [{
        //             label: '# of Votes',
        //             data: [12, 19, 3, 5, 2, 3],
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });




        const data = {
            labels: [
                'Red',
                'Blue',
                'Yellow'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };
    </script>
</x-dashboard.layout>
