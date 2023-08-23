var xValues = ["Present", "Absent"];
var yValues = [attend_chart[0].toFixed(0), attend_chart[1].toFixed(0)];
var barColors = [
    "blue",
    "red",
];

new Chart("myChart", {
    type: "doughnut",
    data: {
        labels: xValues,
        datasets: [{
            backgroundColor: barColors,
            data: yValues
        }]
    },
    options: {
        scales: {
            y: {
                ticks: {
                    font: {
                        size: 30
                    }
                }
            }
        },
        title: {
            display: true,
            text: attend_chart[2] + " Month Attendance Report !",
            fontSize: 20
        },

    }

});
