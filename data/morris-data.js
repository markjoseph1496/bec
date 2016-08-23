$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '1',
            iphone: 4000

        }, {
            period: '2',
            iphone: 2778

        }, {
            period: '3',
            iphone: 4912

        }, {
            period: '4',
            iphone: 3767

        }, {
            period: '5',
            iphone: 6810

        }, {
            period: '6',
            iphone: 5670

        }, {
            period: '7',
            iphone: 4820

        }, {
            period: '8',
            iphone: 15073

        }, {
            period: '9',
            iphone: 10687

        }, {
            period: '10',
            iphone: 10687

        }, {
            period: '11',
            iphone: 8432

        }, {
            period: '13',
            iphone: 8432

        }, {
            period: '14',
            iphone: 8432

        }, {
            period: '15',
            iphone: 8432

        }, {
            period: '16',
            iphone: 8432

        }, {
            period: '17',
            iphone: 8432

        }, {
            period: '18',
            iphone: 8432

        }, {
            period: '19',
            iphone: 8432

        }, {
            period: '20',
            iphone: 8432

        }, {
            period: '21',
            iphone: 8432

        }, {
            period: '22',
            iphone: 8432

        }, {
            period: '23',
            iphone: 8432

        }, {
            period: '24',
            iphone: 8432

        }, {
            period: '25',
            iphone: 8432

        }, {
            period: '26',
            iphone: 8432

        }, {
            period: '27',
            iphone: 8432

        }, {
            period: '28',
            iphone: 8432

        }, {
            period: '29',
            iphone: 8432

        }, {
            period: '30',
            iphone: 8432

        }, {
            period: '31',
            iphone: 8432

        }],
        xkey: 'period',
        ykeys: ['iphone'],
        labels: ['Total Sales'],
        pointSize: 5,
        hideHover: false,
        resize: true,
        xLabelMargin: 10,
        parseTime: false

    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'MFC',
            a: 32366
        }, {
            y: 'RRG',
            a: 36532
        }, {
            y: 'BDP',
            a: 18654
        }, {
            y: 'RGM',
            a: 10356
        }, {
            y: 'JSP',
            a: 28363
        }, {
            y: 'RQC',
            a: 13202
        }, {
            y: 'REC',
            a: 13656
        }],
        xkey: 'y',
        ykeys: 'a',
        labels: ['Total Sales'],
        hideHover: 'auto',
        resize: true,
        xLabelMargin: 10
    });
    
});
