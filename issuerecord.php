<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Please provide your feedback below.</h1>
        <form id="issuereport" >
            <div class="form-group">
                <label for="issuettitle">Issue Title</label>
                <input type="text" name="issuetitle" id="issuetitle" placeholder="Enter the title of issues" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" cols="30" rows="10" placeholder="Description the issue in details" required></textarea>
            </div>
            <div class="form-group">
                <label for="attach-file">Attach Files</label>
                <input type="file" name="attach-files[]" id="attach-file" multiple>
            </div>

            <div id="priority_type_container">
			<label for="priority">Priority: </label>	
					<select id="priority" name="priority">
					<option value="highest">Urgent</option>
					<option value="high">High</option>
					<option value="medium" selected>Medium</option>
					<option value="low">Low</option>
					<option value="lowest">Lowest</option>
				</select>
			</div>

            <div class="form-group">
                <label for="reportedname">Name</label>
                <input type="text" name="reportedname" id="reportedname" placeholder="Reported person name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="ab@email.com" required>
            </div>
            <button type="button" onclick="submitForm()">Submit</button>
            <button type="button" onclick="closeForm()">Close</button>
        </form>
    </div>
    <script>
        function submitForm() {
            const form = document.getElementById('issuereport');
            const formData = new FormData(form);

            // Convert FormData to JSON
            const jsonData = {};
            formData.forEach((value, key) => {
                jsonData[key] = value;
            });

            // Make AJAX request to Laravel backend
            fetch('http://127.0.0.1:8000/api/issuerecords', {
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
                    alert('Error submitting issue. Please try again.');
                } else {
                    // Reload the page on success
                    alert('Issue submitted.');
                    location.reload();
                }
               
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error submitting issue. Please try again.');
            });
        }

        function closeForm() {
            location.reload();
            // Add any logic for closing the form if needed
        }
    </script>
</body>
</html>
