<?php include 'includes/header.php' ?>

   <!-- the first charts(squares) -->
   <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 py-4">
        <!-- Todays expense -->
        <div class="flex flex-col bg-white rounded-lg shadow-lg p-4 w-80">
            <h2 class="text-xl text-green-500 font-medium text-center underline">Todays Expense</h2>
            <div class="flex items-center justify-between py-4">
                <h3 class="text-lg font-bold pl-8">UGX 30000/= </h3>
                <i class="fa fa-pie-chart text-3xl text-green-500"></i>
            </div>
            <div class="flex items-center gap-4">
                <i class="fa fa-long-arrow-up text-3xl text-red-500"></i>
                <h3 class="text-lg "> 10% from Yesterday</h3>
            </div>
        </div>
        <div class="flex flex-col bg-white rounded-lg shadow-lg p-4 w-80">
            <h2 class="text-xl text-green-500 font-medium text-center underline">This Week's Expense</h2>
            <div class="flex items-center justify-between py-4">
                <h3 class="text-lg font-bold pl-8">UGX 30000/= </h3>
                <i class="fa fa-area-chart text-3xl text-yellow-500"></i>
            </div>
            <div class="flex items-center gap-4">
                <i class="fa fa-long-arrow-down text-3xl text-green-500"></i>
                <h3 class="text-lg "> 10% from Last Week</h3>
            </div>
        </div>
        <div class="flex flex-col bg-white rounded-lg shadow-lg p-4 w-80">
            <h2 class="text-xl text-green-500 font-medium text-center underline">This Month's Expense</h2>
            <div class="flex items-center justify-between py-4">
                <h3 class="text-lg font-bold pl-8">UGX 30000/= </h3>
                <i class="fa fa-line-chart text-3xl text-orange-500"></i>
            </div>
            <div class="flex items-center gap-4">
                <i class="fa fa-long-arrow-up text-3xl text-red-500"></i>
                <h3 class="text-lg "> 10% from Last Month</h3>
            </div>
        </div>
        <div class="flex flex-col bg-white rounded-lg shadow-lg p-4 w-80">
            <h2 class="text-xl text-green-500 font-medium text-center underline">This Year's Expense</h2>
            <div class="flex items-center justify-between py-4">
                <h3 class="text-lg font-bold pl-8">UGX 30000/= </h3>
                <i class="fa fa-bar-chart text-3xl text-blue-500"></i>
            </div>
            <div class="flex items-center gap-4">
                <i class="fa fa-long-arrow-down text-3xl text-green-500"></i>
                <h3 class="text-lg "> 10% from Last Year</h3>
            </div>
        </div>
  </div>
  <!-- charts container -->
  <div class="flex flex-col items-center md:flex-row gap-2 mb-2">
      <div class="mx-auto overflow-hidden p-4 bg-white rounded-lg shadow">
          <span class="underline mb-2 font-semibold">Last Week expense per Department</span>
          <canvas
            data-te-chart="bar"
            data-te-dataset-label="Traffic"
            data-te-labels="['Main farm', 'Gulu farm' , 'Masindi farm']"
            data-te-dataset-data="[20000, 30000, 15000]"
            data-te-dataset-background-color="['rgb(255, 0, 0)', 'rgb(0, 102, 255)', 'rgb(0, 204, 0)']" height="300"
            class="w-96 ">
          </canvas>
      </div>
      <div class="mx-auto overflow-hidden p-4 bg-white rounded-lg shadow">
          <span class="underline mb-2 font-semibold">Last Week expense per Department</span>
          <canvas
            data-te-chart="bar"
            data-te-dataset-label="Traffic"
            data-te-labels="['Main farm', 'Gulu farm' , 'Masindi farm','elias farm']"
            data-te-dataset-data="[20000, 30000, 15000, 18000]"
            data-te-dataset-background-color="['rgb(255, 0, 0)', 'rgb(0, 102, 255)', 'rgb(0, 204, 0)','rgb(0, 204, 204)']" height="300"
            class="w-96 ">
          </canvas>
      </div>
      <div class="mx-auto overflow-hidden p-4 bg-white rounded-lg shadow">
          <span class="underline mb-2 font-semibold">Last Week expense per Department</span>
          <canvas
            data-te-chart="line"
            data-te-dataset-label="Traffic"
            data-te-labels="['Main farm', 'Gulu farm' , 'Masindi farm']"
            data-te-dataset-data="[20000, 30000, 15000]"
            data-te-dataset-background-color="['rgb(255, 0, 0)', 'rgb(0, 102, 255)', 'rgb(0, 204, 0)']" height="300" class="w-96 ">
          </canvas>
      </div>

      
  </div>


            <!-- last Activity table -->
            <div class="bg-white p-2 rounded-lg shadow md:w-3/4">
                <span class="font-bold underline">Last Activities</span>
                <div class="flex flex-col gap-2">
                    <div class="flex justify-between items-center p-2 bg-red-100 rounded-lg">
                        <i class="fa fa-bell text-green-500"></i>
                        <span>The Admin Approved budget for Week 4 submiited by Elias (Main farm)</span>
                        <span>Today at 4:30 PM</span>
                    </div>
                    <div class="flex justify-between items-center p-2 bg-green-100 rounded-lg">
                        <i class="fa fa-bell text-green-500"></i>
                        <span>You Approved budget for Week 4 submiited by Elias (Main farm)</span>
                        <span>Today at 4:30 PM</span>
                    </div>
                    <div class="flex justify-between items-center p-2 bg-blue-100 rounded-lg">
                        <i class="fa fa-bell text-green-500"></i>
                        <span>Elias Muhoozi (main farm ) Submitted Budget for week 4 for Approval.</span>
                        <span>Today at 4:30 PM</span>
                    </div>

                    <!-- pagination -->
                    <div class="flex justify-end gap-2">
                        <button class="bg-blue-500 text-white rounded-lg px-4 py-1">Previous</button>
                        <button class="bg-blue-500 text-white rounded-lg px-4 py-1">next</button>
                    </div>
                </div>
            </div>

  <?php include 'includes/footer.php' ?>