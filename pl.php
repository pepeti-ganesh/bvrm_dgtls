<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>
  <link rel="stylesheet" href="pl.css">
 
  

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      // Fetch invoice data from localStorage
      const invoiceData = JSON.parse(localStorage.getItem("invoiceData"));
      if (invoiceData) {
        const { to, city, duration, months, total, startDate, endDate, halftotal } = invoiceData;

        // Populate data into the HTML
        document.getElementById("to").textContent = to;
        document.getElementById("city").textContent = city || "Unknown City";
        document.getElementById("duration").textContent = `${duration} seconds`;
        
        document.getElementById("total").textContent = `₹${total}`;
        document.getElementById("halftotal").textContent = `₹${total/2}`;
        document.getElementById("startDate").textContent = startDate; // Fixed startDate issue

        

        // Populate the pricing table with Start Date and End Date
        const pricingTableBody = document.getElementById("pricing-table-body");
        const row = document.createElement("tr");
        row.innerHTML = `
          <td>${duration} seconds</td>
          
          <td>${startDate}</td>
          <td>${endDate}</td>
          <td>₹${total}</td>
        `;
        pricingTableBody.appendChild(row);
      } else {
        alert("No invoice data available. Please generate an invoice first.");
      }
    });
function printInvoice() {
    const printButton = document.querySelector(".print-button");
    printButton.style.display = "none"; // Hide the button
    window.print();
    printButton.style.display = "block"; // Restore after printing
}

  </script>
</head>
<body>
  <div class="invoice-container">
    <!-- Header -->
    <header>
      <img src="./images/header.png" alt="Company Logo" class="header-logo" style="max-width: 100%;">
    </header>

    <!-- Recipient Section -->
    <section class="to-section">
      <div class="to-left">
        <p><strong>TO:</strong> <span id="to"></span></p>
        <p style=" margin-left: 34px"><strong></strong> <span id="city"></span></p>
      </div>
      <div class="date-right">
        <p><strong>Date:</strong> <span id="startDate"></span></p>
      </div>
    </section>
    
    
    <section>
      <div style="text-align: center;">
        <b>To Whomsoever It May Concern</b>
      </div>
     <p><b> Sub:</b> Quotation for Digital ADs of your brands at  LED Video Wall at ASR Nagar.</p>
     <p><b> AD Timings:</b>  Morning 4:30 AM to 11: 00 AM.<br></p>
         <p  style=" margin-left: 12.5%" >Evening 3:00 PM to 11:00 PM</p>
      
       <b>AD Board Location:  At ‘Y’ Juction above bombaysweets, (18 X 7)</b><br>
       



       <p ><b>For 30 Days :</b>-><span id="duration"></span> Ad Slot </span></p>
        
        
        
        <p style=" margin-left: 12.5%">->100 Cycles <span id="total"></span></p>
        <p style=" margin-left: 12.5%">->50 Cycles <span id="halftotal"></span></p>
        
       
      
    </section>
    
     
    <section class="ad-details">
      <b>Customized Discounted Price:</b>
      <table>
        <thead>
          <tr>
            <th>Duration</th>
            
            <th>Start Date</th>
            <th>End Date</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody id="pricing-table-body">
          <!-- Data will be dynamically added here -->
        </tbody>
      </table>

      
    </section>
     <p> The above discount pricing is valid only if we agree for a 6-months contract | Quote Validity: 1 Week  
      GST/Taxes Not Included in Pricing</p>
      <div class="base">
        <b>Rigards,</b>
        <div>
        <h2>Amrutha Mudunuri</h2>
        <b> Propreitor, Bhimavaram Online</b>
      </div>

      </div>
    
    <footer>
      <div><b>Phone:</b><br>9992223542</div>
      <div><b>Email:</b><br>bhimavaramdigitals@gmail.com</div>
      <div><b>Address:</b>2nd Floor, i-Hub Incubation Center,<br>SRKREC, Bhimavaram, AP, India</div>
    </footer>

    <img src="./images/footer.png" alt="Company Logo" class="header-logo" style="max-width: 100%;">
    <button class="print-button" onclick="printInvoice()">Print Invoice</button>
  </div>
</body>
</html>