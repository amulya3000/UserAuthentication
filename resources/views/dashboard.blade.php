<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Workspace</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f5f9;
            color: #334155;
            margin: 0;
            padding: 40px;
        }
        .workspace-header {
            margin-bottom: 30px;
        }
        .workspace-header h2 {
            margin: 0 0 5px 0;
            color: #0f172a;
        }
        .workspace-header p {
            margin: 0;
            font-size: 14px;
            color: #64748b;
        }
        /* Grid system creating the separate target dashboard task containers */
        .container-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        /* individual container lanes */
        .task-lane {
            background-color: #e2e8f0;
            padding: 20px;
            border-radius: 10px;
            min-hight: 450px;
            border: 1px solid #cbd5e1;
        }
        .lane-title {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
            margin-top: 0;
            margin-bottom: 15px;
            border-b: 2px solid #cbd5e1;
            padding-bottom: 8px;
        }
        /* Individual Task Items inside the container */
        .task-card {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            margin-bottom: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 10px;
        }
        .task-title {
            font-size: 14px;
            font-weight: 600;
            color: #1e293b;
            margin: 0;
        }
        /* Visual priority identifier badge */
        .priority-badge {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            padding: 2px 6px;
            border-radius: 4px;
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }
        .card-footer {
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .assignment-source {
            font-size: 11px;
            color: #94a3b8;
        }
        .action-link {
            font-size: 11px;
            font-weight: 600;
            color: #2563eb;
            text-decoration: none;
        }
        .action-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="workspace-header">
        <h2>Employee Workspace Container</h2>
        <p>Active tasks manually assigned to your workstation dashboard by management.</p>
    </div>

    <!-- The Split Container Board -->
    <div class="container-grid">
        
        <!-- ================= CONTAINER: TO DO LANE ================= -->
        <div class="task-lane">
            <h3 class="lane-title">Assigned (To Do)</h3>
            
            <!-- Sample Task Card 1 -->
            <div class="task-card">
                <div class="card-header">
                    <h4 class="task-title">Optimize Backend Queries</h4>
                    <span class="priority-badge">High</span>
                </div>
                <div class="card-footer">
                    <span class="assignment-source">Assigned by Admin</span>
                    <a href="#" class="action-link">Start Work &rarr;</a>
                </div>
            </div>

            <!-- Sample Task Card 2 -->
            <div class="task-card">
                <div class="card-header">
                    <h4 class="task-title">Review UI Component Accessibility</h4>
                    <span class="priority-badge" style="background-color: #fef3c7; color: #92400e; border-color: #fde68a;">Medium</span>
                </div>
                <div class="card-footer">
                    <span class="assignment-source">Assigned by Admin</span>
                    <a href="#" class="action-link">Start Work &rarr;</a>
                </div>
            </div>
        </div>

        <!-- ================= CONTAINER: IN PROGRESS LANE ================= -->
        <div class="task-lane">
            <h3 class="lane-title">In Development</h3>
            
            <!-- Empty lane placeholder block when no work is active -->
            <div style="text-align: center; padding: 40px 10px; color: #94a3b8; font-size: 13px; border: 2px dashed #cbd5e1; border-radius: 6px;">
                No tasks are currently running in active development.
            </div>
        </div>

    </div>

</body>
</html>