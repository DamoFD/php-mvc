<h1>Create a Cat</h1>
<form style="display: flex; flex-direction: column; width: 25%;" method="POST" action="/public/cat/store">
    <label for="name">Name</label>
    <input id="name" name="name" type="text">
    <label for="age">Age</label>
    <input id="age" name="age" type="number">
    <button type="submit">Submit</button>
    <a href="/public/cat/index">Back</a>
</form>
