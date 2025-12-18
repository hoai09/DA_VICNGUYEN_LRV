$(document).ready(function () {
    $(".chart").easyPieChart({
        barColor: "#f8ac59",
        //                scaleColor: false,
        scaleLength: 5,
        lineWidth: 4,
        size: 80,
    });
    $(".chart2").easyPieChart({
        barColor: "#1c84c6",
        //                scaleColor: false,
        scaleLength: 5,
        lineWidth: 4,
        size: 80,
    });

    if (
        typeof window.DASHBOARD === "undefined" ||
        typeof window.DASHBOARD.projectChart === "undefined"
    )
        return;

    const projectChart = window.DASHBOARD.projectChart;

    let barData = [];
    let lineData = [];

    projectChart.labels.forEach((date, index) => {
        let time = new Date(date).getTime();

        barData.push([time, projectChart.data[index]]);
        lineData.push([time, projectChart.data[index]]);
    });

    let maxY = Math.max(...projectChart.data, 1);

    var dataset = [
        {
            label: "Dự án",
            data: barData,
            color: "#1ab394",
            bars: {
                show: true,
                align: "center",
                barWidth: 24 * 60 * 60 * 1000 * 20,
                lineWidth: 0,
            },
        },
        {
            label: "Xu hướng",
            data: lineData,
            color: "#1C84C6",
            lines: {
                show: true,
                fill: true,
                fillColor: {
                    colors: [{ opacity: 0.2 }, { opacity: 0.4 }],
                },
            },
        },
    ];

    var options = {
        xaxis: {
            mode: "time",
            tickLength: 0,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: "Arial",
            axisLabelPadding: 10,
            color: "#d5d5d5",
        },
        yaxes: [
            {
                position: "left",
                min: 0,
                max: maxY,
                color: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: "Arial",
                axisLabelPadding: 5,
                tickDecimals: 0,
            },
            {
                position: "right",
                min: 0,
                max: maxY,
                color: "#d5d5d5",
                tickDecimals: 0,
            },
        ],

        legend: {
            noColumns: 1,
            labelBoxBorderColor: "#000000",
            position: "nw",
        },
        grid: {
            hoverable: false,
            borderWidth: 0,
        },
    };

    // function gd(year, month, day) {
    //     return new Date(year, month - 1, day).getTime();
    // }

    var previousPoint = null,
        previousLabel = null;

    $.plot($("#flot-dashboard-chart"), dataset, options);
    initProjectStats();

    function initProjectStats() {
        if (
            typeof window.DASHBOARD === "undefined" ||
            typeof window.DASHBOARD.projectChart === "undefined"
        )
            return;

        const chart = window.DASHBOARD.projectChart;
        const data = chart.data || [];

        if (!data.length) return;

        const total = data.reduce((sum, val) => sum + val, 0);

        const current = data[data.length - 1];
        const previous = data.length > 1 ? data[data.length - 2] : 0;

        const average = (total / data.length).toFixed(1);

        let percent = 0;
        if (previous > 0) {
            percent = ((current - previous) / previous) * 100;
        }

        const percentRounded = Math.round(percent);

        $("#stat-total").text(total);
        $("#stat-current").text(current);
        $("#stat-average").text(average);

        const icon =
            percent >= 0
                ? '<i class="fa fa-level-up text-navy"></i>'
                : '<i class="fa fa-level-down text-danger"></i>';

        $("#stat-percent").html(`${Math.abs(percentRounded)}% ${icon}`);

        $("#stat-progress").css(
            "width",
            Math.min(Math.abs(percentRounded), 100) + "%"
        );
    }
});
