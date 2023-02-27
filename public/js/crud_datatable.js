$(document).ready(function () {
    var columnDefs = [
        {
            data: "id",
            title: "ID",
            type: "hidden",
        },
        {
            data: "json",
            title: "JSON",
        },
        {
            data: null,
            title: "Actions",
            name: "Actions",
            type: "hidden",
            render: function (data, type, row, meta) {
                return '<a class="del-btn btn btn-danger me-2" href="#"><i class="bi bi-x-square"></i></a><a class="edit-btn btn btn-success" href="#"><i class="bi bi-pen"></i></a>';
            },
            disabled: true,
        },
    ];

    var my_table = $("#crud_output_table").DataTable({
        ajax: "/api/data",
        dataSrc: "",
        dom: "Bfrtip",
        responsive: true,
        select: {
            style: "single",
            toggleable: false,
        },
        columns: columnDefs,
        buttons: [],
        altEditor: true,
        onAddRow: function (datatable, rowdata, success, error) {
            $.ajax({
                url: "/api/data/store",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                data: JSON.stringify({
                    json: JSON.parse(rowdata["json"]),
                }),
                contentType: "application/json; charset=UTF-8",
                success: function (response) {
                    console.log("success delete");
                    my_table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    // handle error response here
                },
            });
        },
        onDeleteRow: function (datatable, rowdata, success, error) {
            $.ajax({
                url: "/api/data/delete",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                data: JSON.stringify({
                    id_row: rowdata[0]["id"],
                }),
                contentType: "application/json; charset=UTF-8",
                success: function (response) {
                    console.log("success delete");
                    my_table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    // handle error response here
                },
            });
        },
        onEditRow: function (datatable, rowdata, success, error) {
            $.ajax({
                url: "/api/data/edit",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": token,
                },
                data: JSON.stringify({
                    id_row: rowdata["id"],
                    json: rowdata["json"],
                }),
                contentType: "application/json; charset=UTF-8",
                success: function (response) {
                    console.log("success edit");
                    my_table.ajax.reload();
                },
                error: function (xhr, status, error) {
                    // handle error response here
                },
            });
        },
    });

    // Edit
    $(document).on(
        "click",
        "[id^='crud_output_table'] .edit-btn",
        "tr",
        function () {
            var tableID = $(this).closest("table").attr("id"); // id of the table
            var that = $("#" + tableID)[0].altEditor;
            that._openEditModal();
            $("#altEditor-edit-form-" + that.random_id)
                .off("submit")
                .on("submit", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    that._editRowData();
                });
        }
    );

    // Delete
    $(document).on(
        "click",
        "[id^='crud_output_table'] .del-btn",
        "tr",
        function (x) {
            var tableID = $(this).closest("table").attr("id"); // id of the table
            var that = $("#" + tableID)[0].altEditor;
            that._openDeleteModal();
            $("#altEditor-delete-form-" + that.random_id)
                .off("submit")
                .on("submit", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    that._deleteRow();
                });
            x.stopPropagation(); //avoid open "Edit" dialog
        }
    );

    // Add row
    $("#addbutton").on("click", function () {
        var that = $("#crud_output_table")[0].altEditor;
        that._openAddModal();
        $("#altEditor-add-form-" + that.random_id)
            .off("submit")
            .on("submit", function (e) {
                e.preventDefault();
                e.stopPropagation();
                that._addRowData();
            });
    });
});
