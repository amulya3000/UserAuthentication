<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
    <style>
        /* Simple, clean styling resets */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            margin: 0;
            padding: 40px;
        }
        .admin-card {
            background-color: #ffffff;
            max-width: 450px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border: 1px solid #e2e8f0;
        }
        .header-title {
            font-size: 20px;
            font-weight: 600;
            color: #0f172a;
            margin-top: 0;
            margin-bottom: 5px;
        }
        .header-desc {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
            margin-bottom: 8px;
        }
        select, input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            background-color: #f8fafc;
            box-sizing: border-box;
        }
        select:focus, input:focus {
            outline: none;
            border-color: #2563eb;
            background-color: #ffffff;
        }
        .btn-submit {
            width: 100%;
            background-color: #0f172a;
            color: #ffffff;
            padding: 12px;
            font-size: 14px;
            font-weight: 500;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-submit:hover {
            background-color: #1e293b;
        }
    </style>
</head>
<body>

    <div class="admin-card">
        <h2 class="header-title">Admin Control Portal</h2>
        <p class="header-desc">Manually divide tasks and deploy them directly to employee containers.</p>

        <!-- Form layout that hits your backend route -->
        <form action="#" method="POST">
            <!-- Task Blueprint Selector -->
            <div class="form-group">
                <label for="task">Select Task Scope</label>
                <select id="task" name="task_title" required>
                    <option value="" disabled selected>Choose an open task...</option>
                    <option value="Optimize Backend Queries">Optimize Backend Queries</option>
                    <option value="Build Docker Deployment Configuration">Build Docker Deployment Configuration</option>
                    <option value="Review UI Component Accessibility">Review UI Component Accessibility</option>
                </select>
            </div>

            <!-- Target Employee Worker Designation -->
            <div class="form-group">
                <label for="employee">Assign To Employee</label>
                <select id="employee" name="employee_id" required>
                    <option value="1">Amulya Niraula</option>
                    <option value="2">Sarah Jenkins</option>
                    <option value="3">David Cho</option>
                </select>
            </div>

            <!-- Priority Configurations -->
            <div class="form-group">
                <label for="priority">Priority Level</label>
                <select id="priority" name="priority_level">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Deploy Assignment &rarr;</button>
        </form>
    </div>

</body>
</html>