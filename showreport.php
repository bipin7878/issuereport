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
    <h1>Please Solved bellow Isssue</h1>

    <table>
        <thead>
            <tr>
                <th>Issue Title</th>
                <th>Description</th>
                <th>Reported By</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="issuesolves-container">
            <!-- Feedbacks will be displayed here -->
        </tbody>
    </table>

    <script>
        function resolveIssue(issueId) {
            // Navigate to a new page with the individual row data
            window.location.href = `showdetails.php?id=${issueId}`;
        }
    function getIssuesolve() {
        fetch('http://127.0.0.1:8000/api/issusesolves')
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                // Check if the data structure is as expected
                if (data.issuereportforms && Array.isArray(data.issuereportforms) && data.issuereportforms.length > 0) {
                    const issuesolvesContainer = document.getElementById('issuesolves-container');
                    issuesolvesContainer.innerHTML = '';

                    data.issuereportforms.forEach(issue => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                            <td>${issue.issuetitle}</td>
                            <td>${issue.description}</td>
                            <td>${issue.reportedname}</td>
                            <td>${issue.email}</td>
                            <td>
                                   <button onclick="resolveIssue(${issue.id})">Details</button>
                                </td>
                        `;
                        issuesolvesContainer.appendChild(row);
                    });
                } else {
                    console.error('Error: Data structure is not as expected');
                    alert('Error fetching feedbacks. Please try again.');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                alert('Error fetching feedbacks. Please try again.');
            });
    }

    document.addEventListener('DOMContentLoaded', function () {
        getIssuesolve();
    });
</script>

</body>
</html>
