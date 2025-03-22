document.addEventListener('DOMContentLoaded', function() {
    // สีที่ใช้ในกราฟ
    const colors = {
        green: ['#388e3c', '#4caf50', '#81c784', '#c8e6c9']
    };

    // สร้างกราฟ Scores
    const scoresChart = new Chart(document.getElementById('scoresChart'), {
        type: 'bar',
        data: {
            labels: ['ความผูกพัน', 'ความพึงพอใจ', 'สมดุลชีวิต'],
            datasets: [{
                label: 'คะแนนเฉลี่ย',
                data: [4.2, 3.8, 3.5, ],
                backgroundColor: colors.green[1]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    grid: {
                        color: '#f0f0f0'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                }
            }
        }
    });
}); 