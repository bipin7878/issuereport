<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedbacks</title>
    <!-- Add fetch polyfill -->
    <link rel="stylesheet" href="stylesr.css">
    <script src="https://unpkg.com/unfetch/dist/unfetch.umd.js"></script>
    
    
</head>
<body>
    <h1> Isssue Details</h1>
<br>
           
           <button type="button" onclick="returndashboard()">dashboard</button>
           <button type="button" onclick="closeForm()">Close</button>

            <div id="issue-details-container"></div>

            <form id="issuecomment" >
            <div class="form-group">
                <textarea name="comment" id="comment" cols="30" rows="5" placeholder="Write the comments" required></textarea>
            </div>
            <button type="button" onclick="commentForm()">Comment</button>
        </form> 
        
        <div id="comments-container"></div>

    <script> 

    //backto showreport page
    function returndashboard() {
            // Navigate to the dashboard page
            window.location.href = 'showreport.php';
        }

        //show details
     document.addEventListener('DOMContentLoaded',function getIssueDetails() {
            // Extract the issue ID from the URL query parameter
            const urlParams = new URLSearchParams(window.location.search);
            const issueId = urlParams.get('id');

            // Check if the issueId is available
            if (!issueId) {
                console.error('Error: Issue ID not provided in the URL');
                alert('Error fetching issue details. Please provide a valid issue ID.');
                return;
            }

            fetch(`http://127.0.0.1:8000/api/issusesolves/${issueId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    // Check if the data structure is as expected
                    if (data.issuereportform) {
                        const issueDetailsContainer = document.getElementById('issue-details-container');
                        issueDetailsContainer.innerHTML = '';

                        const issue = data.issuereportform;

                        // Create and append elements to display issue details
                        const detailsDiv = document.createElement('div');
                        detailsDiv.innerHTML = `
                            <p><strong>Issue Title:</strong> ${issue.issuetitle}</p>
                            <p><strong>Description:</strong> ${issue.description}</p>
                            <p><strong>Reported By:</strong> ${issue.reportedname}</p>
                            <p><strong>Email:</strong> ${issue.email}</p>
                        `;

                        issueDetailsContainer.appendChild(detailsDiv);
                    } else {
                        console.error('Error: Data structure is not as expected');
                        alert('Error fetching issue details. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Error fetching issue details. Please try again.');
                });
        })

        //commet form 

        function commentForm() {
            const form = document.getElementById('issuecomment');
            const formData = new FormData(form);

            // Convert FormData to JSON
            const jsonData = {};
            formData.forEach((value, key) => {
                jsonData[key] = value;
            });

            // Make AJAX request to Laravel backend
            fetch('http://127.0.0.1:8000/api/comments', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(jsonData),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // Handle the response data
            // Check if there is an error
            if (data.error) {
                    alert('Error comment is not updated. Please try again.');
                } else {
                    // Reload the page on success
                    alert('Comment updated.');
                    location.reload();
                }
               
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error comment . Please try again.');
            });
        }
        function resolveIssue(issueId) {
            // Navigate to a new page with the individual row data
            window.location.href = `showdetails.php?id=${issueId}`;
        }
    //show comments
    document.addEventListener('DOMContentLoaded', function () {
            getComments();
        });

        function getComments() {
            fetch('http://127.0.0.1:8000/api/comments')
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    displayComments(data);
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                    alert('Error fetching comments. Please try again.');
                });
        }

        function displayComments(data) {
            const commentsContainer = document.getElementById('comments-container');
            commentsContainer.innerHTML = '';

            if (data && Array.isArray(data.Comment) && data.Comment.length > 0) {
                data.Comment.forEach(comment => {
                    const commentDiv = document.createElement('div');
                    commentDiv.innerHTML = `
                        <p><strong>Comment:</strong> ${comment.comment}</p>
                    
                        <hr>
                    `;
                    commentsContainer.appendChild(commentDiv);
                });
            } else {
                const noCommentsDiv = document.createElement('div');
                noCommentsDiv.innerHTML = '<p>No comments available.</p>';
                commentsContainer.appendChild(noCommentsDiv);
            }
        }

        
</script>

</body>
</html>
