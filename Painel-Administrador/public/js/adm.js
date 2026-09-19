document.addEventListener("DOMContentLoaded", function () {

  // fecha todos os submenus ao carregar, pra garantir estado inicial
  document.querySelectorAll(".submenu").forEach(function (sm) {
    sm.classList.remove("ativo");
  });

  // menu hamburguer (compactar sidebar)
  const menuBtn = document.getElementById("menuBtn");
  const sidebar = document.getElementById("sidebar");

  if (menuBtn && sidebar) {
    menuBtn.addEventListener("click", function (event) {
      event.preventDefault();
      sidebar.classList.toggle("compacta");
    });
  }

  // abrir/fechar submenus ao clicar na seta
  const botoes = document.querySelectorAll(".imgMaisOpcoes");

  botoes.forEach(function (botao) {
    botao.addEventListener("click", function (event) {
      event.stopPropagation();
      const item = this.closest(".itemsSidebar");
      const submenu = item ? item.querySelector(".submenu") : null;
      if (submenu) {
        submenu.classList.toggle("ativo");
      }
    });
  });

});


//Grafico

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales', 'Expenses'],
          ['2004',  1000,      400],
          ['2005',  1170,      460],
          ['2006',  660,       1120],
          ['2007',  1030,      540]
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }