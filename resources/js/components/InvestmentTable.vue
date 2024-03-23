<template>
  <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
    <main class="w-full flex-grow p-6">
      <h1 class="text-3xl text-black pb-6">Investment Table</h1>

      <div class="w-full mt-6">
        <div class="bg-white p-4 shadow rounded-lg">
          <h3 class="text-lg font-semibold">Total Portfolio Value</h3>
          <p class="text-xl">{{ toCurrency(totalPortfolioValue) }}</p>
        </div>
      </div>

      <div class="w-full mt-6">
        <p class="text-xl pb-3 flex items-center">
          <i class="fas fa-list mr-3"></i> Investment Table
        </p>
        <div class="bg-white overflow-auto">
          <table class="min-w-full bg-white">
            <thead class="bg-gray-800 text-white">
              <tr>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Cryptocurrency</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Amount Invested</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Current Price</th>
                <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Profit/Loss</th>
              </tr>
            </thead>
            <tbody class="text-gray-700">
              <tr v-for="investment in investments" :key="investment.id">
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ investment.cryptocurrency.name }} ({{ investment.cryptocurrency.symbol }})</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ toCurrency(investment.invested_amount) }}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ toCurrency(investment.cryptocurrency.price) }}</td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                  <span :class="profitLossClass(investment)">
                    {{ toCurrency(calculateProfitLoss(investment)) }}
                  </span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  name: 'InvestmentTable',
  data() {
    return {
      investments: [],
      totalPortfolioValue: 0,
    };
  },
  created() {
    this.fetchInvestments();
  },
  methods: {
    async fetchInvestments() {
      try {
        const response = await fetch('/api/investments');
        if (!response.ok) {
          throw new Error('Failed to fetch investments');
        }
        const data = await response.json();
        this.investments = data.investments;
        this.calculateTotalPortfolioValue();
      } catch (error) {
        console.error('Error fetching investments:', error);
      }
    },
    calculateTotalPortfolioValue() {
      this.totalPortfolioValue = this.investments.reduce((total, investment) => {
        return total + (investment.cryptocurrency.price * investment.crypto_amount);
      }, 0);
    },
    calculateProfitLoss(investment) {
      return (investment.cryptocurrency.price - investment.price_at_investment) * investment.crypto_amount;
    },
    profitLossClass(investment) {
      return {
        'text-green-600': this.calculateProfitLoss(investment) > 0,
        'text-red-600': this.calculateProfitLoss(investment) <= 0,
      };
    },
    toCurrency(value) {
      return new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(value);
    },
  },
};
</script>
