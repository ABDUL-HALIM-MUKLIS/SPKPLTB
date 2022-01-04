/* globals Chart:false, feather:false */

const { forEach } = require("lodash")

(function () {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

  // Graphs
  var ctx = document.getElementById('myChart')
  // eslint-disable-next-line no-unused-vars
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      
      // labels: [
      //   'Sunday',
      //   'Monday',
      //   'Tuesday',
      //   'Wednesday',
      //   'Thursday',
      //   'Friday',
      //   'Saturday'
      // ],
      datasets: [{
        data: [
          15339,
          21345,
          18483,
          14003,
          13489,
          14092,
          12034
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
})()