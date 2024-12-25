def find_pair(nums, target):
    #  Empty dictionary to keep track of numbers we've seen
    seen = {}
    
    # Looping through each number in the array
    for num in nums:
        print("Current number:", num)
        
        # Find the number we need to add to the current number to get the target sum
        complement = target - num
        print("Complement needed:", complement)
        
        # Check if the complement exists in the 'seen' dictionary
        if complement in seen:
            # If it exists, we have found a pair
            print(f"Pair found ({complement}, {num})")
            return  # Exit the function since we found the pair
        
        # If the complement is not found, store the current number in the dictionary
        seen[num] = True
        print("Numbers seen so far:", seen)
    
    # If we finish the loop and don't find any pair, print this
    print("Pair not found.")


nums1 = [8, 7, 2, 5, 3, 1]
target1 = 10
print("Pair1")
find_pair(nums1, target1)
print()
print("Next Pair")
nums2 = [5, 2, 6, 8, 1, 9]
target2 = 12
print("Example 2:")
find_pair(nums2, target2)
