var rel1 = new Chart(document.getElementById("rel1"), {
    type: 'line',
    data: {
        labels: ['10/10', '11/10', '12/10', '13/10'],
        datasets: [{
                label: 'Vendas',
                data: [5, 6, 9, 3],
                fill: false,
                backgroundColor: '#0000FF',
                borderColor: '#0000FF'
            },
            {
                label: 'Compras',
                data: [4, 7, 4, 8],
                fill: false,
                backgroundColor: '#FF0000',
                borderColor: '#FF0000'

            }]
    }
});

var rel2 = new Chart(document.getElementById("rel2"), {
    type: 'pie',
    data: {
        labels: ['Pago', 'Pendente'],
        datasets: [{
                data: [7, 2],
                backgroundColor: ['#27ae60', '#D91E18']
        }]
    }

});

