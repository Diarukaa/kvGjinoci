<style>
    .tf-page {
        max-width: 1250px;
        margin: 20px auto 40px;
        color: #172b4d;
        font-family: Arial, sans-serif;
    }

    .tf-page * {
        box-sizing: border-box;
    }

    .tf-hero {
        background: linear-gradient(120deg,#172b4d,#315b89);
        color: white;
        border-radius: 20px;
        padding: 32px;
        margin-bottom: 24px;
    }

    .tf-hero h1 {
        color: white !important;
        margin: 12px 0;
        font-size: 30px;
    }

    .tf-hero p {
        color: #dbeafe;
        font-size: 14px;
        line-height: 1.7;
    }

    .tf-hero small {
        color: #bfdbfe;
        letter-spacing: 1.5px;
        font-weight: bold;
    }

    .tf-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 24px;
        box-shadow: 0 4px 15px rgba(15,23,42,.04);
    }

    .tf-card h2 {
        font-size: 21px;
        margin: 0 0 12px;
    }

    .tf-subtitle {
        font-size: 13px;
        color: #64748b;
        line-height: 1.7;
        margin-bottom: 22px;
    }

    .tf-stats {
        display: grid;
        grid-template-columns: repeat(4,minmax(0,1fr));
        gap: 16px;
        margin-bottom: 24px;
    }

    .tf-stat {
        background: white;
        border: 1px solid #e2e8f0;
        padding: 22px;
        border-radius: 15px;
    }

    .tf-stat small {
        color: #64748b;
        font-size: 12px;
    }

    .tf-stat h2 {
        font-size: 27px;
        margin: 15px 0 0;
    }

    .tf-green {
        color: #15803d;
    }

    .tf-red {
        color: #b91c1c;
    }

    .tf-orange {
        color: #d97706;
    }

    .tf-grid {
        display: grid;
        grid-template-columns: repeat(3,minmax(0,1fr));
        gap: 18px;
    }

    .tf-full {
        grid-column: 1 / -1;
    }

    .tf-page label {
        display: block;
        font-size: 13px;
        font-weight: bold;
        margin-bottom: 8px;
        color: #334155;
    }

    .tf-page input,
    .tf-page select,
    .tf-page textarea {
        width: 100%;
        border: 1px solid #dbe3ee;
        background: #f8fafc;
        padding: 12px;
        border-radius: 8px;
        font-size: 13px;
        color: #172b4d;
        outline: none;
        font-family: inherit;
    }

    .tf-page input:focus,
    .tf-page select:focus,
    .tf-page textarea:focus {
        border-color: #2563eb;
        background: white;
    }

    .tf-page textarea {
        min-height: 85px;
        resize: vertical;
    }

    .tf-btn {
        display: inline-flex;
        justify-content: center;
        align-items: center;
        background: #253858;
        color: white !important;
        border: none;
        border-radius: 8px;
        padding: 12px 17px;
        text-decoration: none !important;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        white-space: nowrap;
    }

    .tf-btn-light {
        background: #e8efff;
        color: #315b89 !important;
    }

    .tf-btn-delete {
        background: #fee2e2;
        color: #b91c1c !important;
    }

    .tf-btn:hover {
        filter: brightness(.94);
    }

    .tf-actions {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .tf-filter {
        display: grid;
        grid-template-columns: 1fr 1fr auto;
        gap: 16px;
        align-items: end;
    }

    .tf-table-wrap {
        overflow-x: auto;
        border-radius: 9px;
    }

    .tf-page table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .tf-page th {
        background: #253858;
        color: white;
        padding: 14px;
        text-align: left;
        font-size: 12px;
    }

    .tf-page td {
        padding: 16px 14px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 13px;
    }

    .tf-badge {
        display: inline-block;
        padding: 7px 10px;
        border-radius: 7px;
        background: #e8efff;
        color: #315b89;
        font-size: 11px;
        font-weight: bold;
    }

    .tf-badge-in {
        background: #dcfce7;
        color: #15803d;
    }

    .tf-badge-out {
        background: #fee2e2;
        color: #b91c1c;
    }

    .tf-message {
        padding: 15px;
        border-radius: 9px;
        margin-bottom: 22px;
        font-size: 13px;
        line-height: 1.8;
    }

    .tf-success {
        background: #dcfce7;
        color: #166534;
    }

    .tf-error {
        background: #fff1f2;
        color: #be123c;
    }

    .tf-empty {
        text-align: center;
        padding: 30px !important;
        color: #64748b;
        font-size: 13px;
    }

    /* Annual bar chart */

    .tf-chart {
        display: grid;
        grid-template-columns: repeat(12,minmax(36px,1fr));
        gap: 12px;
        min-width: 640px;
    }

    .tf-chart-wrap {
        overflow-x: auto;
        padding: 10px 0;
    }

    .tf-chart-month {
        text-align: center;
    }

    .tf-chart-bars {
        display: flex;
        align-items: flex-end;
        justify-content: center;
        height: 180px;
        gap: 5px;
        border-bottom: 1px solid #cbd5e1;
        margin-bottom: 12px;
    }

    .tf-bar {
        width: 20px;
        border-radius: 5px 5px 0 0;
        min-height: 0;
        background: #22c55e;
    }

    .tf-bar-out {
        background: #ef4444;
    }

    .tf-chart-month small {
        font-size: 11px;
        color: #64748b;
    }

    .tf-legend {
        display: flex;
        gap: 20px;
        flex-wrap: wrap;
        font-size: 12px;
        color: #64748b;
        margin-top: 16px;
    }

    .tf-dot {
        display: inline-block;
        width: 11px;
        height: 11px;
        border-radius: 3px;
        margin-right: 5px;
    }

    @media(max-width:850px) {
        .tf-stats,
        .tf-grid {
            grid-template-columns: repeat(2,1fr);
        }
    }

    @media(max-width:550px) {
        .tf-grid,
        .tf-filter {
            grid-template-columns: 1fr;
        }

        .tf-card,
        .tf-hero {
            padding: 18px;
        }

        .tf-stat {
            padding: 16px;
        }

        .tf-stat h2 {
            font-size: 21px;
        }

        .tf-hero h1 {
            font-size: 24px;
        }
    }
</style>
