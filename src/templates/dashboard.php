
<div class="lbr-container lbr-background-muted">
    <div class="lbr-section">
        <form action="" method="POST">
            <div class="lbr-margin">
                <label class="lbr-form-label" for="recipient">To</label>
                <input class="lbr-input lbr-width-1-1" name="recipient" type="text" id="recipient">
            </div>
            <div class="lbr-margin">
                <label class="lbr-form-label" for="subject">Subject</label>
                <input class="lbr-input lbr-width-1-1" name="subject" type="text" id="subject">
            </div>
            <div class="lbr-margin">
                <label class="lbr-form-label" for="message">Message</label>
                <textarea class="lbr-textarea lbr-width-1-1"  name="message" rows="20" id="message"></textarea>
            </div>
            <div class="lbr-margin">
                <button type="submit">send</button>
            </div>
        </form>
    </div>
</div>

<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "allegro", "IDsvW.A!j*XajZ1t", "allegro");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM user";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
        echo "<table>";
            echo "<tr>";
                echo "<th>username</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else{
        echo "No records matching your query were found.";
    }
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>
