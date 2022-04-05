function lineChart(id,data1,data2,data3,data4,data5,data6,data7,data8,data9,data10,label1,label2,label3,label4,label5,label6,label7,label8,label9,label10){

    var ctx = document.getElementById(id).getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [label1,label2,label3,label4,label5,label6,label7,label8,label9,label10],
            datasets: 
            [
                {
                    label: id,
                    data: [data1,data2,data3,data4,data5,data6,data7,data8,data9,data10],
                    backgroundColor: 'rgba(83, 151, 216, 0.4)',
                    borderColor:'rgba(83, 151, 216, 0.6)',
                    borderWidth: 3	
                }
            ]
        },
        
        options: {
            scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
            tooltips:{mode: 'index'},
            legend:{display: true, position: 'top', labels: {fontColor: 'rgb(255,255,255)', fontSize: 16}}
        }
    })
};