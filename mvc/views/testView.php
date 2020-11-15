

<table class="table primary table-bordered">
    <tr>
        <th>Student ID</th>
        <th>Name</th>
        <th>Sex</th>
        <th>E-mail</th>
    </tr>
    <?php   
        foreach ($studentList->result() as $key => $value) {
            echo "<tr>"
                ."<td> $value->studentID</td>"
                ."<td> $value->name</td>"
                ."<td> $value->sex</td>"
                ."<td> $value->email</td>"
                ."<td> Delete | Edit</td>"
                ."</tr>" ;
        }
    ?>
</table>
