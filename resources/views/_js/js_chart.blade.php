<script>
    var ctx = $("#tokenChart");
    var randomScalingFactor = function () {
        return Math.round(Math.random() * 100);
    };

    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    68,
                    15,
                    10,
                    7
                ],
                backgroundColor: [
                    '#FFEE6F',
                    '#F71546',
                    '#6C6C6C',
                    '#CFCFCF',
                ],
                label: 'Dataset 1'
            }],
            labels: [
                '68% Token Sale',
                '15% Team',
                '10% Advisors and Partners',
                '7% Bounties and Airdrops',

            ]
        },
        options: {
            responsive: true,
            cutoutPercentage: 92,

            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            },


            title: {
                display: false,
                text: 'Chart.js Doughnut Chart'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },

            legend: {
                display: false,
            },

            legendCallback: function (chart) {
                var legendHtml = [];
                legendHtml.push('<ul>');
                var item = chart.data.datasets[0];
                for (var i = 0; i < item.data.length; i++) {
                    legendHtml.push('<li>');
                    legendHtml.push('<span class="chart-legend" style="background-color:' + item.backgroundColor[i] + '"></span>');
                    legendHtml.push('<span class="chart-legend-label-text">' + chart.data.labels[i] + '</span>');
                    legendHtml.push('</li>');
                }

                legendHtml.push('</ul>');
                return legendHtml.join("");
            },

        }

    });


    $('#js-legend').html(myDoughnutChart.generateLegend());

    $('.percentBar').each(function (key, elem) {
        var percent = $(elem).data('percent');
        $(elem).find('.percentBar__fill').css('width', percent + '%');
        $(elem).find('.percentBar__marker').css('left', percent + '%');
        $(elem).find('.percentBar__number').text(percent + '%');
        if (percent < 50) {
            $(elem).find('.percentBar__number').css('color', '#BDBDBD');
        }

    });

    $('.owl-carousel').owlCarousel({
        loop: false,
        dots: false,
        nav: true,
        autoWidth: true,
        items: 3,
        navText: ['', ''],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });


    var toggles = document.querySelectorAll(".cmn-toggle-switch");

    for (var i = toggles.length - 1; i >= 0; i--) {
        var toggle = toggles[i];
        toggleHandler(toggle);
    }
    ;

    function toggleHandler(toggle) {
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            $('.jsSidebar').toggleClass('sidebar--mobileVisible');
            $('.jsWorkArea').toggleClass('workArea--shifted');
            (this.classList.contains("active") === true) ? this.classList.remove("active") : this.classList.add("active");
        });
    };
</script>