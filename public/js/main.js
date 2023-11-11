$('#owl1').owlCarousel({

    margin: 10,
    loop: true,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})


$('#owl2').owlCarousel({

    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})


$('#owl3').owlCarousel({

    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})


$('#owl4').owlCarousel({

    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})

$('#owl-all').owlCarousel({
    loop: false,
    margin: 10,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 1
        },
        1000: {
            items: 1
        }
    }
})

$(document).ready(function () {
    $(".sub-side").click(function () {
        $(" #arr").toggleClass("sk");
    });
});


$(document).ready(function () {
    $("#in1").click(function () {
        $(" #icn").hide();
    });
});












// var ctx = document.getElementById('myChart').getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'bar',
//     data: {
//         labels: ['القاهرة', 'الجيزة' , 'الدقهلية', 'الاسماعلية' , 'أسيوط' , 'سيناء' , 'سواج' , 'أسوان' , 'الأقصر' , ],
//         datasets: [{
//             maxBarThickness: 15,
//             label: '# of Votes',
//             data: [12, 19, 50, 60, 88 ,50 ,80 ,90 ,77 ,23, 22],
//             backgroundColor: [
//                 'rgba(255, 159, 64, 1)',
//                 'rgba(255, 159, 64, 1)',
//                 'rgba(255, 159, 64, 1)',
//                 'rgba(255, 159, 64, 1)',
//                 'rgba(255, 159, 64, 1)',
//                 'rgba(255, 159, 64, 1)',
//                 'rgba(255, 159, 64, 1)',
//                 'rgba(255, 159, 64, 1)',
//                 'rgba(255, 159, 64, 1)',
//             ],
//             borderColor: [
//                 'rgba(255, 255, 255, 1)',
//                 'rgba(255, 255, 255, 1)',
//                 'rgba(255, 255, 255, 1)',
//                 'rgba(255, 255, 255, 1)',
//                 'rgba(255, 255, 255, 1)',
//                 'rgba(255, 255, 255, 1)',
//                 'rgba(255, 255, 255, 1)',
//                 'rgba(255, 255, 255, 1)',
//                 'rgba(255, 255, 255, 1)',
//             ],
//             borderWidth: .5
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     max: 150,
//                     min: 0,
//                     stepSize: 50
//                 }
//             }]
//         }
//     }
// });




// const qenooctx = document.getElementById("qenoo").getContext("2d");
// const myqenoochart = new Chart(qenooctx, {
//     // The type of chart we want to create
//     type: "bar",
//     data: {
//         labels: ["1 بنطلون", "2 بنطلون", "3 بنطلون", "4 بنطلون", "5 بنطلون", "6 بنطلون", "7 بنطلون", "8 بنطلون"],
//         datasets: [{
//             maxBarThickness: 35,
//             data: [33, 37, 38, 38, 35, 36, 35, 80, 37, 35, 40, 38],
//             backgroundColor: "#0d6efd",
//         }, ],
//     },
//     options: {
//         cornerRadius: 10,
//         legend: {
//             display: false,
//         },
//         scales: {
//             xAxes: [{
//                 display: true,
//                 gridLines: {
//                     display: false,
//                 },
//                 ticks: {
//                     fontFamily: "arb-medium",
//                     fontColor: "#0d6efd",
//                     fontSize: 14,
//                     stepSize: 1,
//                     beginAtZero: true,
//                 },
//             }, ],
//             yAxes: [{
//                 display: true,
//                 gridLines: {
//                     display: false,
//                 },
//                 ticks: {
//                     beginAtZero: true,
//                     fontFamily: "arb-medium",
//                     fontColor: "#0A66C2",
//                     fontSize: 12,
//                     stepSize: 30,
//                     beginAtZero: true,
//                 },
//             }, ],
//         },
//     },
// });