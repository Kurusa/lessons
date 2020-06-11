<?php
include('connection.php');

$id_edit = $_GET['post_id'];

$id_edit_sql = "SELECT content FROM post WHERE post_id='$id_edit'";

$edit_query = mysqli_query($connection, $id_edit_sql);

while ($row = mysqli_fetch_array($edit_query)) {
    ?>

    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title">Edit your post here</span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="post">

                <div class="modal-body">
                    <textarea CONTENTEDITABLE="true" name="changed_content" id="changed_text"
                              style="
                              font-size: 22px; word-break: break-all; padding: 0!important; text-transform: inherit; max-width: 100%; min-width: 100%"><?= $row["content"] ?></textarea>
                </div>


                <div class="modal-footer">
                    <button name="save_change" type="button" class="btn btn-primary save_change">Save changes</button>
                    <button name="close" type="button" class="btn btn-secondary close_this">Close</button>
                </div>
            </form>
        </div>
    </div>
<?php
}
?>

<script>
    $("#myModal").modal({show: true});

    $(".close_this").click(function () {
        $('#myModal').modal('toggle');
    });

    $(".save_change").click(function () {

        var changed_text = $("#changed_text").val();

        $.ajax({
            url: "all_functions.php",
            type: "POST",
            data: {
                post_id: <?=$_GET["post_id"]?>,
                text: changed_text,
                action: "change_post"
            },
            success: function () {
                $('#myModal').modal('toggle');
                document.getElementById(<?=$_GET["post_id"]?>).innerHTML = changed_text;
            }

    });
    });

</script>