<!-- resources/views/family/tree.blade.php -->

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cây Gia Phả</title>
    <!-- OrgChart.js CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/css/jquery.orgchart.min.css">
    <style>
        #tree-container {
            width: 100%;
            height: 100%;
            overflow: auto;
        }
        .node .title {
            font-size: 14px;
            font-weight: bold;
        }
        .node .content {
            font-size: 12px;
        }
        .node img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: block;
            margin: 0 auto 5px;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Cây Gia Phả</h2>
    <div id="tree-container"></div>

```
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- OrgChart.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/orgchart/2.1.9/js/jquery.orgchart.min.js"></script>

<script>
    $(function() {
        // Dữ liệu cây từ backend, chỉ gồm cha-con
        const treeData = @json($treeData);

        // Chuyển dữ liệu thành dạng OrgChart.js cần
        function buildOrgChartData(nodes) {
            const map = {};
            let root = null;

            nodes.forEach(n => {
                map[n.id] = {...n, children: []};
            });

            nodes.forEach(n => {
                if (n.pid && map[n.pid]) {
                    map[n.pid].children.push(map[n.id]);
                } else {
                    root = map[n.id]; // root node
                }
            });

            return root;
        }

        const orgData = buildOrgChartData(treeData);

        // Tạo OrgChart
        $('#tree-container').orgchart({
            'data' : orgData,
            'nodeContent': 'title',
            'nodeID': 'id',
            'pan': true,
            'zoom': true,
            'createNode': function($node, data) {
                if (data.img) {
                    $node.find('.title').prepend(`<img src="${data.img}" alt="avatar">`);
                }
            }
        });
    });
</script>
```

</body>
</html>
