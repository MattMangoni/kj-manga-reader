$(document).keyup(function(event) {
    var url = $(location).attr('href');
    var urlSplit = url.split("/");
    var getVal = urlSplit.pop();

    if (event.keyCode == 39) {

        var lastPage = $(".pagination ul li:nth-last-child(2)").text();

        console.log(lastPage);

        if (parseInt(getVal) != parseInt(lastPage)) {
            var newVal = parseInt(getVal) + 1;
            urlSplit.push(newVal);
            var newUrl = urlSplit.join("/")
            window.location.replace(newUrl);
        }

    } else if (event.keyCode == 37) {

        if (parseInt(getVal) != 1) {
            var newVal2 = parseInt(getVal) - 1;
            urlSplit.push(newVal2);
            var newUrl2 = urlSplit.join("/")
            window.location.replace(newUrl2);
        }
    }
});