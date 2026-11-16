<style>
    .al-page {
        max-width: 1350px;
        margin: 20px auto 40px;
        color: #172b4d;
        font-family: Arial, sans-serif;
    }

    .al-page * {
        box-sizing: border-box;
    }

    .al-hero {
        background: linear-gradient(
            120deg,#172b4d,#315b89
        );
        color: white;
        padding: 32px;
        border-radius: 20px;
        margin-bottom: 24px;
    }

    .al-hero small {
        color: #bfdbfe;
        letter-spacing: 1.5px;
        font-size: 11px;
        font-weight: bold;
    }

    .al-hero h1 {
        font-size: 32px;
        color: white !important;
        margin: 14px 0;
    }

    .al-hero p {
        font-size: 14px;
        color: #dbeafe;
        line-height: 1.7;
        margin: 0;
    }

    .al-stats {
        display: grid;
        grid-template-columns: repeat(5,minmax(0,1fr));
        gap: 15px;
        margin-bottom: 24px;
    }

    .al-stat {
        background: white;
        border: 1px solid #e2e8f0;
        padding: 21px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(15,23,42,.04);
    }

    .al-stat small {
        color: #64748b;
        font-size: 12px;
    }

    .al-stat h2 {
        font-size: 28px;
        margin: 12px 0 0;
    }

    .al-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 17px;
        padding: 25px;
        margin-bottom: 24px;
        box-shadow: 0 4px 15px rgba(15,23,42,.04);
    }

    .al-card h2 {
        font-size: 22px;
        margin: 0 0 12px;
    }

    .al-subtitle {
        color: #64748b;
        font-size: 13px;
        line-height: 1.7;
        margin-bottom: 22px;
    }

    .al-grid {
        display: grid;
        grid-template-columns: repeat(3,minmax(0,1fr));
        gap: 18px;
    }

    .al-field label {
        display: block;
        font-size: 13px;
        font-weight: bold;
        color: #334155;
        margin-bottom: 9px;
    }

    .al-field input,
    .al-field select {
        width: 100%;
        padding: 12px;
        min-height: 43px;
        border: 1px solid #dbe3ee;
        background: #f8fafc;
        border-radius: 8px;
        font-size: 13px;
        color: #172b4d;
    }

    .al-btn {
        background: #253858;
        color: white !important;
        text-decoration: none !important;
        border: none;
        border-radius: 8px;
        padding: 12px 16px;
        font-size: 12px;
        font-weight: bold;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
    }

    .al-btn-light {
        background: #e8efff;
        color: #315b89 !important;
    }

    .al-btn:hover {
        filter: brightness(.94);
    }

    .al-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 22px;
    }

    .al-table-wrap {
        overflow-x: auto;
        border-radius: 9px;
    }

    .al-page table {
        width: 100%;
        border-collapse: collapse;
        min-width: 850px;
    }

    .al-page th {
        background: #253858;
        color: white;
        font-size: 12px;
        text-align: left;
        padding: 15px;
    }

    .al-page td {
        padding: 16px 14px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 13px;
        vertical-align: top;
        overflow-wrap: anywhere;
    }

    .al-page tbody tr:hover {
        background: #f8fafc;
    }

    .al-badge {
        display: inline-block;
        background: #edf2f7;
        color: #475569;
        border-radius: 7px;
        padding: 7px 10px;
        font-size: 11px;
        font-weight: bold;
        white-space: nowrap;
    }

    .al-created {
        background: #dcfce7;
        color: #15803d;
    }

    .al-updated {
        background: #dbeafe;
        color: #1d4ed8;
    }

    .al-deleted {
        background: #fee2e2;
        color: #b91c1c;
    }

    .al-user {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .al-avatar {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        background: #e8efff;
        color: #315b89;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        flex-shrink: 0;
    }

    .al-muted {
        font-size: 11px;
        color: #64748b;
        line-height: 1.7;
    }

    .al-info-grid {
        display: grid;
        grid-template-columns: repeat(3,minmax(0,1fr));
        gap: 15px;
        margin-bottom: 22px;
    }

    .al-detail {
        padding: 18px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
    }

    .al-detail small {
        color: #64748b;
        display: block;
        font-size: 11px;
        margin-bottom: 9px;
    }

    .al-detail strong {
        font-size: 14px;
        overflow-wrap: anywhere;
    }

    .al-old {
        background: #fff1f2;
        color: #b91c1c;
        padding: 9px 12px;
        border-radius: 7px;
        display: inline-block;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        max-width: 100%;
    }

    .al-new {
        background: #f0fdf4;
        color: #15803d;
        padding: 9px 12px;
        border-radius: 7px;
        display: inline-block;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        max-width: 100%;
    }

    .al-empty {
        text-align: center;
        color: #64748b;
        padding: 35px !important;
    }

    .al-error {
        background: #fff1f2;
        color: #be123c;
        padding: 16px;
        border-radius: 10px;
        margin-bottom: 22px;
        font-size: 13px;
    }

    .al-notice {
        background: #edf4ff;
        color: #315b89;
        padding: 16px;
        border-radius: 10px;
        font-size: 12px;
        line-height: 1.7;
        margin-top: 20px;
    }

    @media(max-width: 950px) {

        .al-stats {
            grid-template-columns: repeat(3,1fr);
        }

        .al-grid,
        .al-info-grid {
            grid-template-columns: repeat(2,1fr);
        }

    }

    @media(max-width: 550px) {

        .al-stats {
            grid-template-columns: repeat(2,1fr);
        }

        .al-grid,
        .al-info-grid {
            grid-template-columns: 1fr;
        }

        .al-card,
        .al-hero {
            padding: 20px;
        }

        .al-hero h1 {
            font-size: 26px;
        }

    }
</style>
