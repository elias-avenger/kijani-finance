//the copyright date
var today = new Date();
document.getElementById("coppy").innerText = today.getFullYear();

//opening and closing the mobile menu
function openM() {
  document.getElementById("menu").style.display = "block";
  document.getElementById("openBtn").style.display = "none";
  document.getElementById("closeBtn").style.display = "block";
}
//closing mobile menu
function closeM() {
  document.getElementById("menu").style.display = "none";
  document.getElementById("openBtn").style.display = "block";
  document.getElementById("closeBtn").style.display = "none";
}

document.addEventListener('DOMContentLoaded', function () {
    // Data for the chart
    const data = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label: 'Sales',
          backgroundColor: ['rgb(75, 192, 192)','rgb(0, 204, 0)'], // Bar color
          borderColor: 'rgba(75, 192, 192, 1)', // Border color
          borderWidth: 1, // Border width
          data: [15000, 20000, 18000, 22000, 25000, 21000, 19000],
        },
      ],
    };

    // Chart configuration options
    const options = {
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Sales Amount ($)',
          },
        },
        x: {
          title: {
            display: true,
            text: 'Month',
          },
        },
      },
    };

    // Create a bar chart
    const ctx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(ctx, {
      type: 'bar',
      data: data,
      options: options,
    });
  });
  document.addEventListener('DOMContentLoaded', function () {
    // Data for the chart
    const data = {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label: 'Sales',
          backgroundColor: ['rgb(75, 192, 192)','rgb(0, 204, 0)'], // Bar color
          borderColor: 'rgba(75, 192, 192, 1)', // Border color
          borderWidth: 1, // Border width
          data: [15000, 20000, 18000, 22000, 25000, 21000, 19000],
        },
      ],
    };

    // Chart configuration options
    const options = {
      scales: {
        y: {
          beginAtZero: true,
          title: {
            display: true,
            text: 'Sales Amount ($)',
          },
        },
        x: {
          title: {
            display: true,
            text: 'Month',
          },
        },
      },
    };

    // Create a bar chart
    const ctx = document.getElementById('monthlChart').getContext('2d');
    new Chart(ctx, {
      type: 'line',
      data: data,
      options: options,
    });
  });