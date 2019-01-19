var rel1 = new Chart(document.getElementById("rel1"), {
    type: 'line',
    data: {
        labels: lista_dia,
        datasets: [{
            label: 'Vendas',
            data: grafico_list,
            fill: false,
            backgroundColor: '#0000FF',
            borderColor: '#0000FF'
        },
            {
                label: 'Compras',
                data: grafico_compra_list,
                fill: false,
                backgroundColor: '#FF0000',
                borderColor: '#FF0000'

            }]
    }
});

var rel2 = new Chart(document.getElementById("rel2"), {
    type: 'pie',
    data: {
        labels: status_nome_list,
        datasets: [{
            data: status_list,
            backgroundColor: ['#D91E18', '#27ae60']
        }]
    }

});

