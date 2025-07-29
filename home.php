<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php
    $conn = new mysqli('localhost', 'root', '', 'votesystem');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="back_image.css">
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">
    <?php include 'includes/navbar.php'; ?>
    <?php include_once 'deadline/timer_test.php';?>
    <div class="content-wrapper">
        <div class="container">
            <section class="content">
                <div class="title">
                <?php
                    $parse = parse_ini_file('admin/config.ini', FALSE, INI_SCANNER_RAW);
                    $title = $parse['election_title'];
                ?>
                </div>
                <h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b></h1>
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <?php
                        if(isset($_SESSION['error'])){
                            echo "
                            <div class='alert alert-danger alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <ul>
                                    ";
                                    foreach($_SESSION['error'] as $error){
                                        echo "
                                            <li>".$error."</li>
                                        ";
                                    }
                                    echo "
                                </ul>
                            </div>
                            ";
                            unset($_SESSION['error']);
                        }
                        if(isset($_SESSION['success'])){
                            echo "
                            <div class='alert alert-success alert-dismissible'>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <h4><i class='icon fa fa-check'></i> Success!</h4>
                                ".$_SESSION['success']."
                            </div>
                            ";
                            unset($_SESSION['success']);
                        }
                        ?>

                        <div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span class="message"></span>
                        </div>

                        <?php
                        $sql = "SELECT * FROM votes WHERE voters_id = '" . $voter['id'] . "'";
                        if ($conn) {
                            $vquery = $conn->query($sql);
                        } else {
                            die("Database connection is not established.");
                        }
                        if($vquery->num_rows > 0){
                            ?>
                            <div class="text-center">
                                <h3>You have already voted for this election.</h3>
                                <a href="#view" data-toggle="modal" class="btn btn-flat btn-primary btn-lg">View Ballot</a>
                            </div>
                            
                            <div id="liveVoteCounts" class="vote-container">
                                <h2 class="vote-header"><b>Live Vote Counts</b></h2>
                                <div id="voteCards" class="vote-cards"></div>
                            </div>
                        <?php
                        } else {
                        ?>
                        <form method="POST" id="ballotForm" action="submit_ballot.php">
                            <?php
                            include 'includes/slugify.php';

                            $candidate = '';
                            $sql = "SELECT * FROM positions ORDER BY priority ASC";
                            $query = $conn->query($sql);
                            while($row = $query->fetch_assoc()){
                                $sql = "SELECT * FROM candidates WHERE position_id='".$row['id']."'";
                                $cquery = $conn->query($sql);
                                while($crow = $cquery->fetch_assoc()){
                                    $slug = slugify($row['description']);
                                    $checked = '';
                                    if(isset($_SESSION['post'][$slug])){
                                        $value = $_SESSION['post'][$slug];

                                        if(is_array($value)){
                                            foreach($value as $val){
                                                if($val == $crow['id']){
                                                    $checked = 'checked';
                                                }
                                            }
                                        }
                                        else{
                                            if($value == $crow['id']){
                                                $checked = 'checked';
                                            }
                                        }
                                    }
                                    $input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red '.$slug.'" name="'.$slug."[]".'" value="'.$crow['id'].'" '.$checked.'>' : '<input type="radio" class="flat-red '.$slug.'" name="'.slugify($row['description']).'" value="'.$crow['id'].'" '.$checked.'>';
                                    $image = (!empty($crow['photo'])) ? 'images/'.$crow['photo'] : 'images/profile.jpg';
                                    $candidate .= '
                                        <li>
                                            '.$input.'<button type="button" class="btn btn-primary btn-sm btn-flat clist platform" data-platform="'.$crow['platform'].'" data-fullname="'.$crow['firstname'].' '.$crow['lastname'].'"><i class="fa fa-search"></i> Platform</button><img src="'.$image.'" height="100px" width="100px" class="clist"><span class="cname clist">'.$crow['firstname'].' '.$crow['lastname'].'</span>
                                        </li>
                                    ';
                                }

                                $instruct = ($row['max_vote'] > 1) ? 'You may select up to '.$row['max_vote'].' candidates' : 'Select only one candidate';

                                echo '
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="box box-solid" id="'.$row['id'].'">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title"><b>'.$row['description'].'</b></h3>
                                                </div>
                                                <div class="box-body">
                                                    <p>'.$instruct.'
                                                        <span class="pull-right">
                                                            <button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="'.slugify($row['description']).'"><i class="fa fa-refresh"></i> Reset</button>
                                                        </span>
                                                    </p>
                                                    <div id="candidate_list">
                                                        <ul>
                                                            '.$candidate.'
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';

                                $candidate = '';
                            }
                            // Submit and Preview buttons
                            echo '
                            <div class="text-center">
                                <button type="button" class="btn btn-success btn-flat" id="preview"><i class="fa fa-file-text"></i> Preview</button> 
                                <button type="submit" name="vote" class="btn btn-primary">Submit Vote</button>
                            </div>
                            ';
                            ?>
                        </form>
						<div id="alert" class="alert alert-danger" style="display:none;">
							<div class="message"></div>
						</div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <?php include 'includes/ballot_modal.php'; ?>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<?php include 'includes/scripts.php'; ?>
<script>
    $('.content').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $(document).on('click', '.reset', function(e){
        e.preventDefault();
        var desc = $(this).data('desc');
        $('.'+desc).iCheck('uncheck');
    });

    $(document).on('click', '.platform', function(e){
        e.preventDefault();
        $('#platform').modal('show');
        var platform = $(this).data('platform');
        var fullname = $(this).data('fullname');
        $('.candidate').html(fullname);
        $('#plat_view').html(platform);
    });

// Modify the preview button click handler
$('#preview').click(function(e){
    e.preventDefault();
    var form = $('#ballotForm').serialize();
    if(form == ''){
        $('.message').html('You must vote at least one candidate');
        $('#alert').show();
    } else {
        $.ajax({
            type: 'POST',
            url: 'preview.php',
            data: form,
            dataType: 'json',
            success: function(response) {
                if(response.error){
                    alert(response.message);
                } else if(response.deadline_passed){
                    alert("The deadline for voting has already passed. Your vote cannot be submitted.");
                } else {
                    // Format the preview content
                    var previewContent = '<h4>Your Vote Preview:</h4>';
                    for (var position in response.list) {
                        previewContent += '<p><strong>' + position + ':</strong> ' + response.list[position] + '</p>';
                    }
                    

                    $('#preview_body').html(previewContent);
                    $('#preview_modal').modal('show');
                }
            },
            error: function(xhr, status, error){
                console.log('Error:', error);
                alert('An error occurred while generating the preview. Please try again.');
            }
        });
    }
});
$(document).ready(function() {
    $('#ballotForm').submit(function(e) {

        var formData = $('#ballotForm').serialize();
        console.log("Form data:", formData);

        // Check if any candidates are selected
        var isAnyCandidateSelected = false;
        $('input[type=radio], input[type=checkbox]').each(function() {
            if (this.checked) {
                isAnyCandidateSelected = true;
                return false; // exit the loop if we find at least one selected candidate
            }
        });

        if (!isAnyCandidateSelected) {
            $('.message').html('Select candidates to vote first');
            $('#alert').show();
            return;
        }

        var deadline = new Date(document.getElementById('timer').dataset.deadline).getTime();
        var now = new Date().getTime();
        if (now > deadline) {
            alert("Voting period has ended. Your vote cannot be submitted.");
            return false;
        }

        // Confirmation dialog
        if (confirm("Are you sure you want to submit your ballot?")) {
            console.log("User confirmed submission.");
            $.ajax({
                type: 'POST',
                url: 'submit_ballot.php',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('.col-sm-10.col-sm-offset-1').html(`
                            <div class="text-center">
                                <h3>Thank you for voting!</h3>
                                <a href="#view" data-toggle="modal" class="btn btn-flat btn-primary btn-lg">View Ballot</a>
                            </div>
                            <div id="liveVoteCounts" class="vote-container">
                                <h2 class="vote-header">Live Vote Counts</h2>
                                <div id="voteCards" class="vote-cards"></div>
                            </div>
                        `);
                        updateVoteCounts();
                        setInterval(updateVoteCounts, 3000);
                    } else {
                        $('.message').html(response.message || 'An error occurred while processing your request.');
                        $('#alert').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                    console.error('Status:', status);
                    console.error('Response:', xhr.responseText);
                    $('.message').html('An error occurred while processing your request. Please check the console for more details.');
                    $('#alert').show();
                }
            });
        } else {
            console.log("User canceled submission.");
            return false; // Prevent the form from submitting
        }
    });
});


  function updateVoteCounts() {
        $.ajax({
            url: 'get_vote_counts.php',
            method: 'GET',
            success: function(data) {
                try {
                    const voteCounts = JSON.parse(data);
                    if (voteCounts.error) {
                        console.error(voteCounts.error);
                        return;
                    }

                    const voteCardsContainer = $('#voteCards');
                    voteCardsContainer.empty();

                    Object.entries(voteCounts).forEach(([position, candidates]) => {
                        const card = $('<div>').addClass('vote-card');
                        const positionElement = $('<div>').addClass('vote-position').text(position);
                        const candidateList = $('<ul>').addClass('candidate-list');

                        Object.entries(candidates).forEach(([candidate, count]) => {
                            const candidateItem = $('<li>').addClass('candidate-item');
                            const candidateName = $('<span>').addClass('candidate-name').text(candidate);
                            const voteCount = $('<span>').addClass('vote-count').text(count);
                            candidateItem.append(candidateName, voteCount);
                            candidateList.append(candidateItem);
                        });

                        card.append(positionElement, candidateList);
                        voteCardsContainer.append(card);
                    });
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
            }
        });
    }

    <?php if($vquery->num_rows > 0): ?>
    updateVoteCounts();
    setInterval(updateVoteCounts, 3000);
    <?php endif; ?>
</script>

<button id="scrollToTopBtn" class="btn btn-primary" title="Go to top" style="display: none; position: fixed; bottom: 20px; right: 20px; z-index: 1000;">
    <i class="fa fa-chevron-up"></i>
</button>
<button id="scrollToDownBtn" class="btn" title="Go to bottom" style="display: none; position: fixed; bottom: 20px; left: 20px; z-index: 1000;">
    <i class="fa fa-chevron-down"></i>
</button>

<script>
// Scroll to Top Button functionality
$(document).ready(function() {
    // Show button when scrolling down
    $(window).scroll(function() {
        if ($(this).scrollTop() > 20) {
            $('#scrollToTopBtn').fadeIn();
        } else {
            $('#scrollToTopBtn').fadeOut();
        }
    });

    // Scroll to top on button click
    $('#scrollToTopBtn').click(function() {
        $('html, body').animate({scrollTop : 0}, 800);
        return false;
    });
});

// Scroll to Down Button functionality
$(document).ready(function() {
    // Show button when scrolling up
    $(window).scroll(function() {
        if ($(this).scrollTop() + $(this).innerHeight() < $(document).height() - 20) {
            $('#scrollToDownBtn').fadeIn();
        } else {
            $('#scrollToDownBtn').fadeOut();
        }
    });

    // Scroll to bottom on button click
    $('#scrollToDownBtn').click(function() {
        $('html, body').animate({scrollTop: $(document).height() - $(window).height()}, 800);
        return false;
    });
});

</script>

</body>
</html>