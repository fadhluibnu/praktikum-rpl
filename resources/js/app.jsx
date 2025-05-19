import ReactDOM from "react-dom/client";
import React, { useState } from "react";
import { Line } from "react-chartjs-2";
import { Chart as ChartJS } from "chart.js/auto";

function App() {
    // Initial data for the chart
    const initialData = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
            {
                label: "Sales in 2025",
                data: [30, 40, 35, 50, 70],
                borderColor: "rgba(75,192,192,1)",
                tension: 0.1,
            },
        ],
    };

    const [chartData, setChartData] = useState(initialData);
    const [month, setMonth] = useState("");
    const [count, setCount] = useState(0);

    const increment = () => setCount(count + 1);
    const decrement = () => setCount(count > 0 ? count - 1 : 0);

    const handleSubmit = (e) => {
        e.preventDefault();

        // Make a copy of the current labels and data
        const labels = [...chartData.labels];
        const data = [...chartData.datasets[0].data];

        // Check if the month already exists
        const monthIndex = labels.indexOf(month);

        if (monthIndex === -1) {
            // If the month does not exist, add it to labels and data
            labels.push(month);
            data.push(count);
        } else {
            // If the month exists, update its sales value
            data[monthIndex] = count;
        }

        // Update the chart data
        setChartData({
            ...chartData,
            labels,
            datasets: [
                {
                    ...chartData.datasets[0],
                    data,
                },
            ],
        });

        // Reset the form inputs
        setMonth("");
        setCount(0);
    };

    return (
        <div className="min-h-screen bg-gray-100 flex flex-col items-center justify-center font-sans">
            <a
                href="/"
                class="pt-2 mb-4 inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-5 w-5 mr-2"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
                Back to Home
            </a>
            <h1 className="text-4xl font-bold text-blue-600 mb-8">
                Dynamic Sales Chart
            </h1>

            {/* Chart Section */}
            <div className="bg-white shadow-lg rounded-lg p-6 mb-8 w-full max-w-md">
                <h3 className="text-xl font-semibold mb-4">Sales Data</h3>
                <div className="w-full">
                    <Line data={chartData} />
                </div>
            </div>

            {/* Form Section */}
            <div className="bg-white shadow-lg rounded-lg p-6 w-full max-w-md">
                <form onSubmit={handleSubmit} className="space-y-4">
                    <div className="flex flex-col">
                        <label className="text-sm font-medium mb-1">
                            Month:
                        </label>
                        <input
                            type="text"
                            value={month}
                            onChange={(e) => setMonth(e.target.value)}
                            className="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="e.g., January"
                        />
                    </div>
                    <div className="flex flex-col mt-4">
                        <label className="text-sm font-medium mb-1">
                            Sales Count:
                        </label>
                        <div className="flex items-center space-x-4">
                            <button
                                type="button"
                                onClick={decrement}
                                className="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition"
                            >
                                −
                            </button>
                            <span className="text-lg font-bold">{count}</span>
                            <button
                                type="button"
                                onClick={increment}
                                className="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition"
                            >
                                +
                            </button>
                        </div>
                    </div>
                    <button
                        type="submit"
                        className="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition mt-4"
                    >
                        Submit
                    </button>
                </form>
            </div>
        </div>
    );
}

const root = ReactDOM.createRoot(document.getElementById("root"));
root.render(<App />);
