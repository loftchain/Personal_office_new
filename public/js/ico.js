(function () {

  "use strict";

  
  Vue.config.devtools = true;



var buyTokensApp = new Vue({
  el: '#buyTokens',
  data: {
    name: 'buyTokens',
    invsetmentWalletETH: 'cjsdxhnaa634a345623564v2x5237zb646',
    minumumDeposit: '0,1',
    gas: '199 000',
  },
  // определяйте методы в объекте `methods`
  methods: {
    copyToBuffer: function (event) {
      console.log('ok');
      var copyText = document.getElementById("ethWallet");
      copyText.select();

      /* Copy the text inside the text field */
      document.execCommand("copy");

      /* Alert the copied text */
      alert("Copied: " + copyText.value);


    },

    onCopy: function (e) {
      alert('You just copied: ' + e.text)
    },
    onError: function (e) {
      alert('Failed to copy texts')
    }
  }
});



  var drop = $("#files");
  drop.on('dragenter', function (e) {
    $(".drop").css({
      "border": "4px dashed #09f",
      "background": "rgba(0, 153, 255, .05)"
    });
    $(".cont").css({
      "color": "#09f"
    });
  }).on('dragleave dragend mouseout drop', function (e) {
    $(".drop").css({
      "border": "3px dashed #DADFE3",
      "background": "transparent"
    });
    $(".cont").css({
      "color": "#8E99A5"
    });
  });


  $('.jsChangePassword').click(function() {
    $('.changeEmail').hide();
    $('.changePassword').show();
    
  })

  $('.jsChangeEmail').click(function() {
    $('.changePassword').hide();
    $('.changeEmail').show();
  })



  // function handleFileSelect(evt) {
  //   var files = evt.target.files; // FileList object
  //
  //   // Loop through the FileList and render image files as thumbnails.
  //   for (var i = 0, f; f = files[i]; i++) {
  //
  //     // Only process image files.
  //     if (!f.type.match('image.*')) {
  //       continue;
  //     }
  //
  //     var reader = new FileReader();
  //
  //     // Closure to capture the file information.
  //     reader.onload = (function (theFile) {
  //       return function (e) {
  //         // Render thumbnail.
  //         var span = document.createElement('span');
  //         span.innerHTML = ['<img class="thumb" src="', e.target.result,
  //           '" title="', escape(theFile.name), '"/>'].join('');
  //         document.getElementById('list').insertBefore(span, null);
  //       };
  //     })(f);
  //
  //     // Read in the image file as a data URL.
  //     reader.readAsDataURL(f);
  //   }
  // }

  // $('#files').change(handleFileSelect);



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
  };

  function toggleHandler(toggle) {
    toggle.addEventListener("click", function (e) {
      e.preventDefault();
      $('.jsSidebar').toggleClass('sidebar--mobileVisible');
      $('.jsWorkArea').toggleClass('workArea--shifted');
      (this.classList.contains("active") === true) ? this.classList.remove("active") : this.classList.add("active");
    });
  }

})();


