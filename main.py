import os

def get_files_and_colors(root_dir):
    file_paths_and_colors = []
    
    for root, dirs, files in os.walk(root_dir):
        files.sort()
        for file in files:
            color = os.path.basename(root)
            file_path = f"{color}/{file}"
            file_paths_and_colors.append((file_path, color))
    
    return file_paths_and_colors

root_directory = 'candidates/'
file_data = get_files_and_colors(root_directory)

file_data.sort(key=lambda x: x[1])

current_color = None
ca_number = 1

for file_path, color in file_data:
    if color != current_color:
        current_color = color
        ca_number = 1

    sql = f"INSERT INTO candidates (ca_number, ca_image, ca_color) VALUES ('{ca_number}', '{file_path}', '{color}');"
    print(sql)
    
    ca_number += 1
