function drawChart(canvasId,x,y,title="",chartType="line"){

    

    var ctx = document.getElementById(canvasId).getContext('2d');
    var myChart = new Chart(ctx, {
       
        data: {
            labels: x, //[1, 2,3,4,5,6],  //Ici les X
            datasets: [{
                type: chartType, // 'line',   //line,pie,scatter,bar,polarArea,doughnut...
                label: 'Ligne Test',
                data:y, // [12, 19, 3, 50, 200, 300],   //Ici les Y
                backgroundColor: [
                    'rgba(255, 109, 132,1)',
                    'rgba(75, 192, 192, 1)',
                ],
                borderColor: [
                    'black',
                    // 'rgba(54, 162, 235, 1)', //si plusieurs couleurs alors 1 sur deux de cette couleur
                ],
                hoverBackgroundColor:[
                    'red'
                ],
    
                borderWidth: 2,
                // hoverOffset: 4
            },
    
            // {
            //     type: 'bar',
            //     label: 'BarTest',
            //     data: [2, 9, 14, 4, 2, 1],
            //     backgroundColor: [
            //         'rgba(255, 109, 132, 0.2)',
            //         'rgba(75, 192, 192, 0.2)',
            //     ],
            //     borderColor: [
            //         'rgba(255, 99, 132, 1)',
            //     //    "blue",
            //     ],
            //     borderWidth: 2,
            
            // }
        ]
        },
    
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                title: {
                    display: true,
                    text:title, // 'Chart Title', //Ici le titre
                    // fullSize: false,
                    // position:"bottom",
                    // font:{
    
                    // }
                }
            },
            animation:{
                easing:'easeInOutCubic',
                
                // loop:true
            }
        }
    });
    
    }