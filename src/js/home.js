

window.onload = function() {

var MaxLiderName="";
var MaxLider=0;
var MaxParName="";
var MaxPar=0;
var MaxSubordinadoName="";
var MaxSubordinado=0;

//Reporte contestados
fetch('./api/Reporte/all.php')
.then(function(response) {
   if (response.status===200) {

     console.log(response)
 // Do stuff with the response
response.json().then(function updateFromOnline(data) {

    console.log(data.result);

 var IDU= new Array('');

 for (var i = 0; i < data.result.length; i++) {
   var Lider = 0.0;
   var Par = 0.0;
   var Subordinado = 0.0;
   var sum = 0.0;
     //alert(data.result[i].IDUsuario);
   if(!IDU.includes(data.result[i].IDUsuario))
   {
     for(var j = 0; j < data.result.length; j++){
       //alert(data.result[j].IDUsuario);
       if(data.result[i].IDUsuario == data.result[j].IDUsuario)
       {
         if(data.result[j].Lider > 0){
           Lider = data.result[j].Lider;
           if(Lider>MaxLider)
           {
             MaxLider = trunc(Lider,2);
             MaxLiderName = "1."+data.result[j].Nombre;
           }
         }
         if(data.result[j].Par > 0){
           Par = data.result[j].Par;
           if(Par>MaxPar)
           {
             MaxPar = trunc(Par,2);
             MaxParName = "2."+data.result[j].Nombre;
           }
         }
         if(data.result[j].Subordinado > 0){
           Subordinado = data.result[j].Subordinado;
           if(Subordinado>MaxSubordinado)
           {
             MaxSubordinado = trunc(Subordinado,2);
             MaxSubordinadoName = "3."+data.result[j].Nombre;
           }
         }
         if(!IDU.includes(data.result[j].IDUsuario))
         {
           IDU.push(data.result[j].IDUsuario);
         }
         sum += parseFloat(data.result[j].Lider) + parseFloat(data.result[j].Par) + parseFloat(data.result[j].Subordinado);
       }

       //console.log("Sum: " + sum);
     }

       var avg = sum/3;
       //console.log(avg);
       console.log("id: " + data.result[i].IDUsuario + " AVG: " + avg +
       " Lider: " + Lider  + " Cont: " + data.result[i].Contestadas_Lider + " De: " + data.result[i].De_Lider +
       " Par: " + Par  + " Cont: " + data.result[i].Contestadas_Par + " De: " + data.result[i].De_Par +
       " Subordinado: " + Subordinado + " Cont: " + data.result[i].Contestadas_Subordinado + " De: " + data.result[i].De_Subordinado);

   }
  }
});
}
});

google.charts.load("current", {
  packages: ["corechart"]
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {


  var data = google.visualization.arrayToDataTable([
      ['Seccion', MaxLiderName, MaxParName, MaxSubordinadoName],
      ['1.Lider', MaxLider, 0, 0],
      ['2.Par', 0 , MaxPar, 0],
      ['3.Subordinado', 0, 0, MaxSubordinado]
    ]);

    var optionsBar = {
      chart: {
        title: 'Mejores Resultados',
      }
    };


  /* Data feed from array.*/
  var arraywoopen = [
    ['Task', 'WO Open Status']
  ];

  arraywoopen.push(['Assigned', 18]);
  arraywoopen.push(['In Progress', 37]);
  arraywoopen.push(['Pending', 70]);
  arraywoopen.push(['Planning', 16]);
  arraywoopen.push(['Waiting Approval', 6]);

  var datawoopen = google.visualization.arrayToDataTable(arraywoopen);

 /* Hardcoded data*/
  var datawoage = google.visualization.arrayToDataTable([
    ['Task', 'Open WO Age'],
    ['< 1 Week', 20],
    ['1-4 Wks', 13],
    ['5-12 Wks', 23],
    ['12 Wks-1 Yr', 77],
    ['> 1 Year Approval', 14]
  ]);

  var datawo30dclosed = google.visualization.arrayToDataTable([
    ['Task', 'WO 30 days closed'],
    ['Claire Sanford', 33],
    ['Karon Peryam', 24],
    ['Adam Tham', 13],
    ['Zhanna Illarionova', 13],
    ['Mike Fitzgibbons', 10],
    ['Preston Hale', 5],
    ['Yasser Qureshi', 3],
    ['Clovis Melebeck', 2],
    ['Raymond Ramirez', 2],
    ['Saroja Muppalla', 2],
    ['Arun Arangil', 1],
    ['Randolph Reyes', 1],
  ]);

  var datawoopencount = google.visualization.arrayToDataTable([
    ['Task', 'Open WO Count'],
    ['Claire Sanford', 19],
    ['Karon Peryam', 19],
    ['Adam Tham', 18],
    ['Zhanna Illarionova', 17],
    ['Mike Fitzgibbons', 14],
    ['Preston Hale', 9],
    ['Yasser Qureshi', 3],
    ['Clovis Melebeck', 2],
    ['Raymond Ramirez', 2],
    ['Saroja Muppalla', 2],
    ['Arun Arangil', 1],
    ['Randolph Reyes', 1],
  ]);

  var datadevopsbackloghours = google.visualization.arrayToDataTable([
    ["BacklogHours", "Backlog Hours", {
      role: "style"
    }],
    ["4-Mar", 1399, "#005273"],
    ["17-Mar", 1422, "#005273"],
    ["30-Mar", 1654, "#005273"],
    ["12-Apr", 1766, "#005273"],
    ["21-May", 2455, "#005273"],
    ["2-June", 3500, "#005273"],
    ["21-May", 4500, "#005273"],
    ["3-Sep", 4677, "#005273"],
    ["15-Sep", 3800, "#005273"],
  ]);

  var view = new google.visualization.DataView(datadevopsbackloghours);
  view.setColumns([0, 1, {
      calc: "stringify",
      sourceColumn: 1,
      type: "string",
      role: "annotation"
    },
    2
  ]);
  var optiondevopsbackloghours = {
    title: "DevOps Backlog Hours",
    width: 800,
    height: 400,
    bar: {
      groupWidth: "90%"
    },
    legend: {
      position: "none"
    }
  };
  var chartoptiondevopsbackloghours = new google.visualization.ColumnChart(document.getElementById("DevOpscolumnchart_values"));
  chartoptiondevopsbackloghours.draw(view, optiondevopsbackloghours);



  var chart = new google.visualization.ColumnChart(document.getElementById('columnchart_material'));
  chart.draw(data, optionsBar);

  var options = {
    is3D: true,
    sliceVisibilityThreshold: 0
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechartwopenstatus_3d'));
  chart.draw(datawoopen, options);

  var chartwoage = new google.visualization.PieChart(document.getElementById('piechartwoage_3d'));
  chartwoage.draw(datawoage, options);

  var chartwo30d = new google.visualization.PieChart(document.getElementById('piechartwo30d_3d'));
  chartwo30d.draw(datawo30dclosed, options);

  var chartwoopencount = new google.visualization.PieChart(document.getElementById('piechartwoopencount_3d'));
  chartwoopencount.draw(datawoopencount, options);

}

}
