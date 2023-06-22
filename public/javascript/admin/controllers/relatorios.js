$(document).ready(function () {

    function relgeral() {
        $.ajax({
            url: 'http://' + window.location.host + '/coworking/admin/relatorios/getrelgeral',
            method: "GET",
            success: function (data) {
                //console.log(data);
                var total = new Array();
                var cor = [];
                
                for (var i in data) {
                    //console.log(data);
                    total.push(data[i].total);
                    cor.push(data[i].cor);
                  
                }
                
                var chartdata = {
                    labels:  total,
                    datasets: [
                        {
                            label: ['Quantidade'],
                            backgroundColor: getColors(12),
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data:  total 
                        }
                    ]
                };

                var cty = $("#relgeralbar");

                var barGraph = new Chart(cty, {
                    type: 'bar',
                    data: chartdata,
                    options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Quantidade Total de Reservas igual a '+ total
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                });

            },
            error: function (data) {
                console.log(data);
            }
        });
    }
    function reldiaria() {
        $.ajax({
            url: 'http://' + window.location.host + '/coworking/admin/relatorios/getreldiaria',
            method: "GET",
            success: function (data) {
                //console.log(data);
                var dt = new Array();
                var cor = [];
                var id = [];

                for (var i in data) {
                    //console.log(data);
                    dt.push(data[i].dt);
                    cor.push(data[i].cor);
                    id.push(data[i].id);
               
                }
                
                var chartdata = {
                    labels: dt,
                    datasets: [
                        {
                            label: ['Quantidade'],
                            backgroundColor: getColors(12),
                            //backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: id 
                            
                        }
                    ]
                };

                var cty = $("#reldiariabar");

                var barGraph = new Chart(cty, {
                    type: 'bar',
                    data:   chartdata,
                    options: {
                        legend: { display: false },
                        title: {
                            display: true,
                            text: 'Quantidade de Reservas por Dia'
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    min: 0,
                                    stepSize: 1
                                }
                            }]
                        }
                    }
                });

            },
            error: function (data) {
                console.log(data);
            }
        });
    }

   
    //----fim ----------
    function barchart() {
        var ctx = $('#barChart').get(0).getContext('2d');

        var data = {
            labels: ["Chocolate", "Vanilla", "Strawberry"],
            datasets: [
                {
                    label: "Blue",
                    backgroundColor: "blue",
                    data: [3, 7, 4]
                },
                {
                    label: "Red",
                    backgroundColor: "red",
                    data: [4, 3, 5]
                },
                {
                    label: "Green",
                    backgroundColor: "green",
                    data: [7, 2, 6]
                }
            ]
        };

        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                barValueSpacing: 20,
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0,
                        }
                    }]
                }
            }
        });

    }

    function initGraph() {
        relgeral();
        reldiaria();
      
    }

    //Metodo prático de validar vazios em JS
    function testa_empty(val) {
        if (val === undefined)
            return true;
        if (typeof (val) == 'function' || typeof (val) == 'number' || typeof (val) == 'boolean' || Object.prototype.toString.call(val) === '[object Date]')
            return false;
        if (val == null || val.length === 0) // null or 0 length array
            return true;
        if (typeof (val) == "object") {
            // empty object

            var r = true;

            for (var f in val) {
                r = false;
            }
            return r;
        }
        return false;
    }

    function getSafe(fn, defaultVal) {
        try {
            return fn();
        } catch (e) {
            return defaultVal;
        }
    }

    function getColors(c = 1) {
        var cor = new Array();

        for (var i = 0; i < c; i++) {
            cor.push(getRandomColor());
        }

        return cor;
    }

    function getRandomColor() {
        var letters = '0123456789ABCDEF'.split('');
        var color = '#';
        for (var i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }

    initGraph();

});

