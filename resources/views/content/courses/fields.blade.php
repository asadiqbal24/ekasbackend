<div class="card">
    <div class="card-body">

        <h4 class="card-title">{{ $heading }}</h4>
        <p class="card-title-desc">{{ $sub_heading }}</p>

        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Enter Title</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="title" placeholder="Enter Tittle...."
                    value="{{ $course->title ?? '' }}">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>


        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Universirty Name and &
                Location</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="namelocation"
                    placeholder="Enter University Name & Location...." value="{{ $course->namelocation ?? '' }}">
                    @error('namelocation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>





        <div class="mb-3 row">
            <label for="example-datetime-local-input" class="col-md-2 col-form-label">Application Open</label>
            <div class="col-md-10">
                <input class="form-control" name="Applicationopen" type="datetime-local"
                    id="example-datetime-local-input" value="{{ $course->Applicationopen ?? \Carbon\Carbon::now() }}">
                    @error('Applicationopen')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>



    </div>

</div>





<div class="card">
    <div class="card-body">
        <h4 class="card-title">Add Key information</h4>
        <p class="card-title-desc">You can add your Key information here</p>
        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">University Name</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="universityname"
                    placeholder="Enter University Name ...." value="{{ $course->universityname ?? '' }}">
                    @error('universityname')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>

        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Programme Name</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="programmename" placeholder="Enter Programme name ...."
                    value="{{ $course->programmename ?? '' }}">
                    @error('programmename')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>


        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">University
                Ranking</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="ranking" placeholder="University ranking name ...."
                    value="{{ $course->ranking ?? '' }}">
                    @error('ranking')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>




        <div class="mb-3 row">
            <label class="col-md-2 col-form-label">Select Course Level</label>
            <div class="col-md-10">
                <select class="form-control" name="level">
                    <option value="Bachelors">Bachelors</option>
                    <option value="Masters">Masters</option>
                    <option value="PhD">PhD</option>
                    <option value="Others">Others</option>
                </select>
                @error('level')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>






        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Course Ranking</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="courseranking" placeholder="Course ranking name ...."
                    value="{{ $course->courseranking ?? '' }}">
                    @error('courseranking')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>




        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Tuition Fee(€)</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="tuitionfee" placeholder="Enter Tuition ..."
                    value="{{ $course->tuitionfee ?? '' }}">
                    @error('tuitionfee')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>





        <div class="mb-3 row">
            <label class="col-md-2 col-form-label">Select Location</label>
            <div class="col-md-10">
                <select class="form-control" name="location">
                    <option value="Austria">Austria</option>
                    <option value="Finland">Finland</option>
                    <option value="Belgium">Belgium</option>

                </select>
                @error('location')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>




        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">Entry
                Requirement</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="EntryRequirement"
                    placeholder="Entry Requirement ..." value="{{ $course->EntryRequirement ?? '' }}">
                    @error('EntryRequirement')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>


        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">IELTS/TOFEL
                Requirement</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="IELTSTOFELRequirement"
                    placeholder="IELTS/TOFEL Requirement ..." value="{{ $course->IELTSTOFELRequirement ?? '' }}">
                    @error('IELTSTOFELRequirement')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>



        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">GRE/GMAT/SAT
                Requirement</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="GREGMATSATRequirement"
                    placeholder="GRE/GMAT/SAT Requirement ..." value="{{ $course->GREGMATSATRequirement ?? '' }}">
                    @error('GREGMATSATRequirement')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>




        <div class="mb-3 row">
            <label class="col-md-2 col-form-label">Select Study Mode</label>
            <div class="col-md-10">
                <select class="form-control" name="studymode">
                    <option value="Half Time">Half Time</option>
                    <option value="Full Time">Full Time</option>
                </select>
                @error('studymode')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>









        <div class="mb-3 row">
            <label for="example-datetime-local-input" class="col-md-2 col-form-label">Application
                Deadline</label>
            <div class="col-md-10">
                <input class="form-control" name="ApplicationDeadline" type="datetime-local" id="example-datetime-local-input"
                    value="{{ $course->ApplicationDeadline ?? \Carbon\Carbon::now() }}">
                    @error('studymode')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>


        <div class="mb-3 row">
            <label for="example-text-input" class="col-md-2 col-form-label">URL</label>
            <div class="col-md-10">
                <input class="form-control" type="text" name="URL" placeholder="URL ..."
                    value="{{ $course->URL ?? '' }}">
                    @error('URL')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" name="submit" class="btn btn-primary w-md">Submit</button>
        </div>
