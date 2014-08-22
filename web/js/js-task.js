/**
 * Created by alex on 21.08.14.
 */

$(function() {
    var tableId = 'someData';
    Table.createTable(tableId, 'container');
    $('#search').on('keyup', {'tableId': tableId}, Table.search);
    $('#hideLines').on('click', {'tableId': tableId}, Table.hide);
});


Table = {
    tableId : '',
    containerId : '',
    createTable : function(tableId, containerId) {
        this.tableId = tableId;
        this.containerId = containerId;
        var content = '<table id="' + tableId + '">';
        for(i = 0; i < 10; i++) {
            content += '<tr>';
            for(j = 0; j < 10; j++) {
                content += '<td>' + 'Data ' + i + '-' + j + '</td>';
            }
            content += '</tr>';
        }
        content += "</table>"
        $('#' + containerId).append(content);
    },

    search : function(event) {
        var str = event.target.value;
        var tableId = event.data.tableId;
        $('#' + tableId).find('td').removeHighlight().highlight(str);
    },

    hide : function (event) {
        var tableId = event.data.tableId;
        if (event.target.checked) {
            $('#' + tableId).find("span.highlight").parent().parent().hide();
        } else {
            $('#' + tableId).find("tr").show();
        }
    }
};