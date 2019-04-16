
<link rel="stylesheet" type="text/css" href="<?= BASE_PATH ?>views/public/css/outlines/add.css">
<main>
    <div class="row">
            <div class="container margin__t__b">
            <div class="col-sm-4">
                <div class="center-content">
                    <img width="200" height="auto" src="<?= BASE_PATH ?>views/public/images/outlinesimages/graphic1.svg" alt="pen and paper graphic">
                    <p class="paragraph">Use the form to create a new project outline. Companies can use this outline to send requests for collaboration.
                        Think about the type of project you want for your students to meet the required course curriculum.
                    </p>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="col-sm-10 col-sm-offset-1">
                    <div>
                        <div>
                            <h3>Use the form below to create an outline.</h3>
                            <form class="center-block" action="<?=BASE_PATH?>outlines/addOutline" method="post">
                                <fieldset>
                                    <legend>Outline</legend>
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control c-input" name="name" placeholder="What is your outline name?">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description:</label>
                                        <textarea rows="7" class="form-control c-input" name="description" placeholder="Describe the general scope of your outline"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="technology">Technology:</label>
                                        <input type="text" class="form-control c-input" name="technologies" placeholder="Required technologies to meet your curriculum">
                                    </div>
                                    <div class="form-group">
                                        <label for="course">Course:</label>
                                        <input type="text" class="form-control c-input" name="course" placeholder="Course you are teaching">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="minimum memebrs">Minimum Members:</label>
                                            <select id="inputState" name="min_members" class="form-control c-input">
                                                <option selected>Select </option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="maxmembers">Maximum Members:</label>
                                            <select id="inputState" name="max_members" class="form-control c-input">
                                                <option selected>Select</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                                <option>9</option>
                                                <option>10</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Start Date:</label>
                                            <input type="date" id="inputState" name="start_date" class="form-control c-input" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Due Date:</label>
                                            <input type="date" id="inputState" name="due_date" class="form-control c-input" />
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="maxmembers">Status:</label>
                                            <select id="inputState" name="published" class="form-control c-input">
                                                <option selected>Select</option>
                                                <option>Publish</option>
                                                <option>Save</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-row">

                                        <div class="col-md-12">
                                            <div class="col-md-4 col-md-offset-8">
                                                <input type="submit" name="btn-add-outline" class="btn btn-primary c-btn" value="Create">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    </div>
</main>

