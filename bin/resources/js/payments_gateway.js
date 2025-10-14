document.addEventListener("DOMContentLoaded", function () {
    console.log("Payments Gateway JS loaded");

    // Ví dụ render dữ liệu mẫu
    const tableBody = document.getElementById("payments-table-body");

    const sampleData = [
        {
            id: "GD001",
            customer: "Nguyễn Văn A",
            amount: "2,500,000 đ",
            method: "Thẻ tín dụng",
            status: "Thành công",
            date: "2025-10-01",
        },
        {
            id: "GD002",
            customer: "Trần Thị B",
            amount: "1,200,000 đ",
            method: "Momo",
            status: "Chờ xử lý",
            date: "2025-09-30",
        }
    ];

    sampleData.forEach(item => {
        const row = `
            <tr>
                <td class="px-6 py-4 text-sm text-gray-900">${item.id}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${item.customer}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${item.amount}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${item.method}</td>
                <td class="px-6 py-4 text-sm ${item.status === 'Thành công' ? 'text-green-600' : 'text-yellow-600'}">${item.status}</td>
                <td class="px-6 py-4 text-sm text-gray-900">${item.date}</td>
                <td class="px-6 py-4 text-sm">
                    <button class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                        Xem
                    </button>
                </td>
            </tr>
        `;
        tableBody.insertAdjacentHTML("beforeend", row);
    });
});
