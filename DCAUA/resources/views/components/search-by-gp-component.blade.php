<div class="d-flex flex-wrap mt-2 ">
    <form action="" id="serach_form_date" class="d-flex col-12 flex-wrap">
        @csrf
        {{-- Serach By dates  --}}
        {{-- <h5 class="text-uppercase fs-5">Serach By Date</h5> --}}
        <div class="d-flex col-12 mt-2">
            <div class="d-flex align-items-center col-12">
                <div class="d-flex col-6 align-items-center">
                    <span class="me-1">From</span>
                    <input type="date" name="from_date_form" class="border rounded  p-1 "
                        style="width:100%;outline:none;">
                </div>
                <div class="col-6 d-flex align-items-center">
                    <span class="me-1">To</span>
                    <input type="date" name="to_date_form" class="border  rounded p-1"
                        style="width:100%;outline:none;">
                </div>
            </div>

        </div>

        {{-- Search by GP Name --}}
        <div class="d-flex col-12 mt-2">
            <div class="col-4">
                <p class="fs-6">{{ $district_name }}</p>
            </div>
            <div class="col-4 ">
                <p>{{ $block_name }}</p>
            </div>
            <div class="col-4 ">
                <select class="form-select" name="gp_name" aria-label="Default select example">
                    <option disabled selected>Select</option>
                    @foreach ($gp_names as $gp_name)
                        <option value="{{ $gp_name->gram_panchyat_id }}">{{ $gp_name->gram_panchyat_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="d-flex col-12 justify-content-center">
            <button class="col-md-2 btn btn-primary" for="btncheck1">Serach...</button>
        </div>
    </form>
</div>
