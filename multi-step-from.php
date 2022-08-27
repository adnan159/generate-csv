<!DOCTYPE html>
<html>
<head>
  <style type="text/css">

    /** {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    }
    body {
        font-family: "Montserrat";
    }
    section {
        min-height: 100vh;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: aliceblue;
    }
    .container {
        max-width: 400px;
        width: 90%;
        padding: 20px;
        box-shadow: 0px 0px 20px #00000020;
        border-radius: 8px;
        background-color: white;
    }*/
    .step {
        display: none;
    }
    .step.active {
        display: block;
    }
    /*.form-group {
        width: 100%;
        margin-top: 20px;
    }
    .form-group input {
        width: 100%;
        border: 1.5px solid rgba(128, 128, 128, 0.418);
        padding: 5px;
        font-size: 18px;
        margin-top: 5px;
        border-radius: 4px;
    }*/
    /*button.next-btn,
    button.previous-btn,
    button.submit-btn {
        float: right;
        margin-top: 20px;
        padding: 10px 30px;
        border: none;
        outline: none;
        background-color: rgb(180, 220, 255);
        font-family: "Montserrat";
        font-size: 18px;
        cursor: pointer;
    }*/
    /*button.previous-btn {
        float: left;
    }
    button.submit-btn {
        background-color: aquamarine;
    }
*/  </style>
</head>
<body>

  <?php

  ?>

  <section>
    <div class="container">
        <form>
            <div class="step step-1 active">
                <button type="button" class="next-btn">Export</button>
            </div>
            <div class="step step-2">
                <div class="form-group" style="display:flex; flex-direction: column;">
                    <label for="total-review">Total number of Review</label>
                    <input type="number" id="total-review" name="total-review" />
                    <label for="skip-no">Skip first n review</label>
                    <input type="number" id="skip-no" name="skip-review" />
                    <label for="date-from">Start Date</label>
                    <input type="date" id="date-from" name="date-from" />
                    <label for="date-to">End Date</label>
                    <input type="date" id="date-to" name="date-to" />
                    <label for="post-name">Post/Product</label>
                    <select id="post-name" name="post-name">
                      <option value="all">All</option>
                      <option value="album">Album</option>
                    </select>
                    <label for="selected-review">Select Review</label>
                    <select id="selected-review" name="selected-review">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                    <label for="reviewer-type">Customer/Guest Review</label>
                    <select id="reviewer-type" name="reviewer-type">
                      <option value="all">All</option>
                      <option value="customer">Customer</option>
                      <option value="guest">Guest</option>
                    </select>
                    <label for="status">Status</label>
                    <select id="status" name="status">
                      <option value="all">All</option>
                      <option value="private">Private</option>
                      <option value="draft">Draft</option>
                      <option value="publish">Publish</option>
                      <option value="future">Future</option>
                    </select>
                    <label for="sort-columns">Sort Columns</label>
                    <select id="sort-columns" name="sort-columns">
                      <option value="commnet-id">Commnet ID</option>
                      <option value="comment-date">Comment Date</option>
                    </select>
                    <label for="sort-by">Sort By</label>
                    <select id="sort-by" name="sort-by">
                      <option value="ascending">Ascending</option>
                      <option value="decending">Descending</option>
                    </select>
                </div>
                <button type="button" class="previous-btn">Prev</button>
                <button type="button" class="next-btn">Next</button>
            </div>
            <div class="step step-3">
                <div class="form-group">
                    <label for="country">country</label>
                    <input type="text" id="country" name="country" />
                </div>
                <button type="button" class="previous-btn">Prev</button>
                <button type="submit" class="submit-btn">Submit</button>
            </div>
        </form>
    </div>
  </section>

  <script>

   const steps = Array.from(document.querySelectorAll("form .step"));  
   const nextBtn = document.querySelectorAll("form .next-btn");  
   const prevBtn = document.querySelectorAll("form .previous-btn");  
   const form = document.querySelector("form");  
   nextBtn.forEach((button) => {  
    button.addEventListener("click", () => {  
     changeStep("next");  
    });  
   });  
   prevBtn.forEach((button) => {  
    button.addEventListener("click", () => {  
     changeStep("prev");  
    });  
   });  
   form.addEventListener("submit", (e) => {  
    e.preventDefault();  
    const inputs = [];  
    form.querySelectorAll("input, select").forEach((input) => {  
     const { name, value } = input;  
     inputs.push({ name, value });  
    });  
    console.log(inputs);  
    form.reset();  
   });  
   function changeStep(btn) {  
    let index = 0;  
    const active = document.querySelector(".active");  
    index = steps.indexOf(active);  
    steps[index].classList.remove("active");  
    if (btn === "next") {  
     index++;  
    } else if (btn === "prev") {  
     index--;  
    }  
    steps[index].classList.add("active");  
   }  


  </script>

</body>
</html>

