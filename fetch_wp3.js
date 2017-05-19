/**
 * Created by Davide Pavone on 19/05/2017.
 */
var request = new Request('http://192.168.118.148/~user/Project/ApiLudo.php?table=events', {
    method: 'GET'
});

fetch(request).then(function (response) {
    return response.json();
}).then(function (response2) {
    console.log('JSON: ', response2);
    for (var i = 0; i < response2.length; i++) {
        console.log(response2[i]);
    }
    this.getJSON(response2.json(), function (data) {
        this.each(data, function (i, f) {
            var tblRow = "<tr>" + "<td>" + f.eventID + "</td>" +
                "<td>" + f.persoonID + "</td>" + "<td>" + f.datum + "</td>" + "</tr>";
            this(tblRow).appendTo("#userdata tbody");
        });

    });

}).catch(function (err) {
    console.log(err.message);
});

