buttons: [
        {
                extend: 'csv',
                //Name the CSV
                filename: 'file_name',
                text: 'Customized CSV',
                exportOptions: {
                        columns: [0, 1, $("#name_column"), $("#test_column"), $("#height_column"), $("#area_column")]
                },
                //Function which customize the CSV (input : csv is the object that you can preprocesss)
                customize: function (csv) {
                        //Split the csv to get the rows
                        var split_csv = csv.split("\n");

                        //Remove the row one to personnalize the headers
                        split_csv[0] = '"Latitude","Longitude","Site Name","Description","Antenna Height","Antenna gain","Env loss","Candidate"';

                        //For each row except the first one (header)
                        $.each(split_csv.slice(1), function (index, csv_row) {
                                //Split on quotes and comma to get each cell
                                var csv_cell_array = csv_row.split('","');

                                //Remove replace the two quotes which are left at the beginning and the end (first and last cell)
                                csv_cell_array[0] = csv_cell_array[0].replace(/"/g, '');
                                csv_cell_array[5] = csv_cell_array[5].replace(/"/g, '');

                                //RANDOM EXAMPLE : Make some test, special cutomizing depending of the value of the cell (if cell 5 is equal to a certain value, give a value to row 6)
                                if (csv_cell_array[5].toLowerCase().trim() == "a certain value") {
                                        csv_cell_array[6] = "2";
                                }
                                else if (csv_cell_array[5].toLowerCase() == "another value") {
                                        csv_cell_array[6] = "5";
                                }
                                //Else, define an empty 6th cell
                                else {
                                        csv_cell_array[6] = "";
                                }

                                //RANDOM EXAMPLE : Empty the 5th cell and set the 7th to true
                                csv_cell_array[5] = "";
                                csv_cell_array[7] = "true";

                                //Join the table on the quotes and comma; add back the quotes at the beginning and end
                                csv_cell_array_quotes = '"' + csv_cell_array.join('","') + '"';

                                //Insert the new row into the rows array at the previous index (index +1 because the header was sliced)
                                split_csv[index + 1] = csv_cell_array_quotes;
                        });

                        //Join the rows with line breck and return the final csv (datatables will take the returned csv and process it)
                        csv = split_csv.join("\n");
                        return csv;
                }
        }
